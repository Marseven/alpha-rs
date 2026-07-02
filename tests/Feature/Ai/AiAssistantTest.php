<?php

namespace Tests\Feature\Ai;

use App\Models\AiQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiAssistantTest extends TestCase
{
    use RefreshDatabase;

    public function test_assistant_page_is_reachable(): void
    {
        $this->get('/assistant')->assertOk();
    }

    public function test_simple_question_returns_an_answer_and_is_stored(): void
    {
        // AI disabled by default in tests -> safe fallback, no crash.
        $this->post('/assistant', [
            'question' => 'Quels documents faut-il pour ouvrir un dossier ?',
        ])->assertOk()->assertSee('Relief Services', false);

        $this->assertDatabaseHas('ai_questions', [
            'question' => 'Quels documents faut-il pour ouvrir un dossier ?',
            'status' => AiQuestion::NEEDS_HUMAN_REVIEW,
        ]);
    }

    public function test_medical_question_returns_a_caution_message(): void
    {
        $this->post('/assistant', [
            'question' => "J'ai mal au coeur, quel médicament prendre ?",
        ])->assertOk()->assertSee('diagnostic', false);

        $q = AiQuestion::latest()->first();
        $this->assertStringContainsString('professionnel qualifié', $q->answer);
        $this->assertSame(AiQuestion::ANSWERED, $q->status);
    }

    public function test_site_does_not_crash_when_ai_disabled(): void
    {
        config(['relief.ai.enabled' => false]);
        $this->post('/assistant', ['question' => 'Comment vous contacter ?'])->assertOk();
    }

    public function test_answer_comes_from_provider_when_enabled(): void
    {
        config(['relief.ai.enabled' => true, 'relief.ai.api_key' => 'test-key']);
        Http::fake([
            'api.openai.com/*' => Http::response([
                'choices' => [['message' => ['content' => 'Voici les étapes pour un devis.']]],
            ], 200),
        ]);

        $this->post('/assistant', ['question' => 'Comment demander un devis ?'])
            ->assertOk()
            ->assertSee('Voici les étapes pour un devis', false);

        $this->assertDatabaseHas('ai_questions', ['status' => AiQuestion::ANSWERED]);
    }
}
