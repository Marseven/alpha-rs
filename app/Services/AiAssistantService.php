<?php

namespace App\Services;

use App\Models\AiKnowledgeEntry;
use App\Models\AiQuestion;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/**
 * Simple, guarded Q&A assistant for Relief Services visitors.
 * - Never gives medical diagnosis/prescription (guarded before any AI call).
 * - Only answers about the service, steps, documents, tracking, contacts.
 * - Fails safe: if the AI is disabled/unconfigured, returns a clean fallback
 *   instead of crashing.
 */
class AiAssistantService
{
    // Stored accent-free + lowercase; the question is normalized the same way
    // before matching (see normalize()), so "symptôme"/"symptome" both hit.
    private const MEDICAL_MARKERS = [
        // FR
        'diagnos', 'prescri', 'medicament', 'medoc', 'posologie', 'ordonnance',
        'symptome', 'douleur', 'mal au', 'mal de', 'urgence', 'dose', 'traitement',
        'maladie', 'remede', 'analyse medical', 'operation', 'chirurgie', 'cancer', 'covid',
        // EN
        'medication', 'dosage', 'symptom', 'disease', 'treatment', 'painkiller', 'remedy', 'prescription',
    ];

    private const MEDICAL_ANSWER = "Je ne peux pas donner de diagnostic ou de prescription médicale. "
        . "Pour toute question médicale ou une urgence, contactez immédiatement un médecin ou "
        . "contactez Relief Services pour être orienté vers un professionnel qualifié.";

    public function ask(string $question, array $meta = []): AiQuestion
    {
        $question = trim($question);

        // 1) Guard: medical/sensitive questions never reach the AI.
        if ($this->isMedical($question)) {
            return $this->persist($question, $meta, self::MEDICAL_ANSWER, AiQuestion::ANSWERED);
        }

        // 2) Curated knowledge base — instant answer (works even without an AI key).
        if ($answer = $this->knowledgeMatch($question)) {
            return $this->persist($question, $meta, $answer, AiQuestion::ANSWERED);
        }

        // 3) AI disabled or not configured -> safe fallback (human follow-up).
        if (! config('relief.ai.enabled') || empty(config('relief.ai.api_key'))) {
            return $this->persist($question, $meta, $this->fallbackMessage(), AiQuestion::NEEDS_HUMAN_REVIEW);
        }

        // 4) Call the provider with a constrained prompt.
        try {
            $answer = $this->callProvider($question);

            return $this->persist($question, $meta, $answer, AiQuestion::ANSWERED);
        } catch (\Throwable $e) {
            Log::warning('AI assistant call failed: ' . $e->getMessage());

            return $this->persist($question, $meta, $this->fallbackMessage(), AiQuestion::FAILED);
        }
    }

    private function isMedical(string $question): bool
    {
        $q = $this->normalize($question);
        foreach (self::MEDICAL_MARKERS as $marker) {
            if (str_contains($q, $marker)) {
                return true;
            }
        }

        return false;
    }

    /** Lowercase + strip diacritics so accented and English/plain spellings both match. */
    private function normalize(string $text): string
    {
        return mb_strtolower(\Illuminate\Support\Str::ascii($text));
    }

    /** Direct FAQ answer when the question hits an active entry's keywords. */
    private function knowledgeMatch(string $question): ?string
    {
        if (! Schema::hasTable('ai_knowledge_entries')) {
            return null;
        }

        $q = $this->normalize($question);

        foreach (AiKnowledgeEntry::active()->whereNotNull('keywords')->get() as $entry) {
            $needles = preg_split('/[,;\s]+/', $this->normalize($entry->keywords), -1, PREG_SPLIT_NO_EMPTY) ?: [];
            foreach ($needles as $needle) {
                if (mb_strlen($needle) >= 3 && str_contains($q, $needle)) {
                    return $entry->answer;
                }
            }
        }

        return null;
    }

    /** Active entries injected into the AI prompt as authoritative context. */
    private function knowledgeContext(): string
    {
        if (! Schema::hasTable('ai_knowledge_entries')) {
            return '';
        }

        $entries = AiKnowledgeEntry::active()->latest()->limit(50)->get();
        if ($entries->isEmpty()) {
            return '';
        }

        $faq = $entries->map(fn ($e) => "- Q : {$e->question}\n  R : {$e->answer}")->implode("\n");

        return "\n\nBase de connaissances Relief Services (utilise ces réponses en priorité si la question s'y rapporte) :\n" . $faq;
    }

    private function callProvider(string $question): string
    {
        $context = config('relief.name') . ' — ' . config('relief.description')
            . ' Contact: ' . config('relief.contact_email') . ' ' . config('relief.contact_phone') . '.';

        $system = "Tu es l'assistant de {$context} "
            . "Réponds uniquement sur : services proposés, étapes pour demander un devis, "
            . "documents nécessaires, suivi d'un dossier, contacts et démarches générales. "
            . "Reste bref, clair et professionnel, en français. "
            . "Ne donne JAMAIS de diagnostic, de prescription ni de recommandation médicale. "
            . "Ne promets aucune prise en charge non confirmée. "
            . "Si l'information n'est pas connue, invite à contacter Relief Services."
            . $this->knowledgeContext();

        $response = Http::withToken(config('relief.ai.api_key'))
            ->timeout(20)
            ->post(rtrim(config('relief.ai.base_url', 'https://api.openai.com/v1'), '/') . '/chat/completions', [
                'model' => config('relief.ai.model', 'gpt-4o-mini'),
                'temperature' => 0.2,
                'max_tokens' => 400,
                'messages' => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user', 'content' => $question],
                ],
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Provider HTTP ' . $response->status());
        }

        $answer = trim((string) data_get($response->json(), 'choices.0.message.content', ''));

        return $answer !== '' ? $answer : $this->fallbackMessage();
    }

    private function fallbackMessage(): string
    {
        $email = config('relief.contact_email');
        $phone = config('relief.contact_phone');
        $contact = trim(($email ? " par email ($email)" : '') . ($phone ? " ou téléphone ($phone)" : ''));

        return "Merci pour votre question. Un conseiller Relief Services vous répondra"
            . ($contact !== '' ? " — vous pouvez aussi nous contacter{$contact}." : '.');
    }

    private function persist(string $question, array $meta, string $answer, string $status): AiQuestion
    {
        return AiQuestion::create([
            'name' => $meta['name'] ?? null,
            'phone' => $meta['phone'] ?? null,
            'email' => $meta['email'] ?? null,
            'question' => $question,
            'answer' => $answer,
            'source_context' => config('relief.name'),
            'status' => $status,
        ]);
    }
}
