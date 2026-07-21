{{-- Floating assistance widget — mounted site-wide. Offers two clearly visible
     channels: the guarded AI assistant (route assistant.chat, reusing
     AiAssistantService) and a WhatsApp handoff (wa.me). The WhatsApp message is
     a fixed, PII-free text; the number comes from config (falls back to the
     contact phone). Bot messages are rendered with textContent (XSS-safe). --}}
@php
    $waRaw = config('relief.whatsapp.number') ?: config('relief.contact_phone');
    $waNumber = preg_replace('/\D/', '', (string) $waRaw);
    $waEnabled = config('relief.whatsapp.enabled', true) && $waNumber !== '';
    $waHref = $waEnabled
        ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode((string) config('relief.whatsapp.message'))
        : null;
@endphp
<div id="rs-chat" class="fixed bottom-5 right-5 z-50 print:hidden">

    {{-- Panel --}}
    <div id="rs-chat-panel" class="mb-3 hidden w-[360px] max-w-[calc(100vw-2.5rem)] flex-col overflow-hidden rounded-2xl border border-line bg-white shadow-card-lg">
        <div class="flex items-center gap-3 bg-primary-900 px-4 py-3 text-white">
            <span class="flex h-9 w-9 flex-none items-center justify-center rounded-full bg-white/15">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4m0 0H8m4 0h4M4 12a8 8 0 0 1 16 0v4a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-4Z"/><path d="M9 13h.01M15 13h.01"/></svg>
            </span>
            <div class="min-w-0 flex-1">
                <div class="font-display text-sm font-bold leading-tight">Assistant Relief Services</div>
                <div class="text-[11px] text-primary-200">Réponse rapide à vos questions</div>
            </div>
            @if ($waHref)
                <a href="{{ $waHref }}" target="_blank" rel="noopener" title="Contacter un conseiller sur WhatsApp"
                   class="flex h-8 w-8 items-center justify-center rounded-full text-primary-100 transition-colors hover:bg-white/10 hover:text-white" aria-label="Contacter sur WhatsApp">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22h.004c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0 0 12.04 2Zm0 1.67c2.2 0 4.27.86 5.82 2.42a8.2 8.2 0 0 1 2.42 5.82c0 4.54-3.7 8.24-8.25 8.24a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.11.82.83-3.04-.2-.31a8.18 8.18 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24Zm4.52 10.31c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.13-.16.25-.64.8-.79.97-.14.16-.29.19-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.13-.14.17-.25.25-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.42-.14-.01-.31-.01-.48-.01-.16 0-.43.06-.66.31-.23.25-.86.85-.86 2.07 0 1.22.89 2.4 1.01 2.56.12.16 1.74 2.66 4.22 3.73.59.25 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.14-1.18-.06-.11-.22-.17-.47-.29Z"/></svg>
                </a>
            @endif
            <button type="button" onclick="rsChatToggle(false)" class="flex h-8 w-8 items-center justify-center rounded-full text-primary-200 hover:bg-white/10 hover:text-white" aria-label="Fermer">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>

        <div id="rs-chat-msgs" class="flex h-80 max-h-[55vh] flex-col gap-2.5 overflow-y-auto bg-white px-4 py-4"></div>

        <div class="border-t border-line bg-white px-3 py-2">
            <div class="flex items-end gap-2">
                <textarea id="rs-chat-input" rows="1" maxlength="1000" placeholder="Écrivez votre question…"
                    class="max-h-28 w-full resize-none rounded-xl border-[1.5px] border-line-strong px-3 py-2 text-sm text-ink focus:border-primary-600 focus:ring-2 focus:ring-primary-600/15"></textarea>
                <button type="button" onclick="rsChatSend()" id="rs-chat-send" aria-label="Envoyer"
                    class="flex h-10 w-10 flex-none items-center justify-center rounded-xl bg-primary-600 text-white transition-colors hover:bg-primary-700 disabled:opacity-50">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </button>
            </div>
            <p class="mt-1.5 px-1 text-[10.5px] leading-tight text-ink-faint">L'assistant ne remplace pas un avis médical. Pour un diagnostic, contactez un professionnel de santé.</p>
        </div>
    </div>

    {{-- Floating button --}}
    <button type="button" onclick="rsChatToggle()" id="rs-chat-fab" aria-label="Ouvrir l'assistant"
        class="ml-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary-600 text-white shadow-cta ring-4 ring-primary-600/15 transition-transform hover:scale-105">
        <svg id="rs-chat-fab-open" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 10h.01M12 10h.01M16 10h.01"/></svg>
        <svg id="rs-chat-fab-close" class="hidden h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>

    <script>
        (function () {
            const url = @json(route('assistant.chat'));
            const waHref = @json($waHref);
            const panel = document.getElementById('rs-chat-panel');
            const msgs = document.getElementById('rs-chat-msgs');
            const input = document.getElementById('rs-chat-input');
            const iconOpen = document.getElementById('rs-chat-fab-open');
            const iconClose = document.getElementById('rs-chat-fab-close');
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
            let sending = false, greeted = false;

            function bubble(text, who) {
                const wrap = document.createElement('div');
                wrap.className = 'flex ' + (who === 'user' ? 'justify-end' : 'justify-start');
                const b = document.createElement('div');
                b.className = who === 'user'
                    ? 'max-w-[82%] whitespace-pre-wrap rounded-2xl rounded-br-sm bg-primary-600 px-3.5 py-2 text-sm text-white'
                    : 'max-w-[82%] whitespace-pre-wrap rounded-2xl rounded-bl-sm border border-line bg-canvas px-3.5 py-2 text-sm text-ink';
                b.textContent = text;                 // textContent → pas d'injection HTML
                wrap.appendChild(b);
                msgs.appendChild(wrap);
                msgs.scrollTop = msgs.scrollHeight;
                return wrap;
            }
            // A green WhatsApp call-to-action (used as a choice on open and as an
            // escalation when the assistant cannot answer). Fixed, PII-free text.
            function waCta(label) {
                if (!waHref) return;
                const wrap = document.createElement('div');
                wrap.className = 'flex justify-start';
                const a = document.createElement('a');
                a.href = waHref;
                a.target = '_blank';
                a.rel = 'noopener';
                a.className = 'inline-flex items-center gap-2 rounded-xl border border-[#25D366]/40 bg-[#25D366]/10 px-3.5 py-2 text-sm font-semibold text-[#128C4B] transition-colors hover:bg-[#25D366]/20';
                a.textContent = label;
                wrap.appendChild(a);
                msgs.appendChild(wrap);
                msgs.scrollTop = msgs.scrollHeight;
            }
            function typing() {
                const wrap = document.createElement('div');
                wrap.className = 'flex justify-start';
                wrap.innerHTML = '<div class="flex gap-1 rounded-2xl rounded-bl-sm border border-line bg-canvas px-3.5 py-3"><span class="h-1.5 w-1.5 animate-bounce rounded-full bg-ink-faint"></span><span class="h-1.5 w-1.5 animate-bounce rounded-full bg-ink-faint" style="animation-delay:.15s"></span><span class="h-1.5 w-1.5 animate-bounce rounded-full bg-ink-faint" style="animation-delay:.3s"></span></div>';
                msgs.appendChild(wrap);
                msgs.scrollTop = msgs.scrollHeight;
                return wrap;
            }

            window.rsChatToggle = function (force) {
                const open = typeof force === 'boolean' ? force : panel.classList.contains('hidden');
                panel.classList.toggle('hidden', !open);
                panel.classList.toggle('flex', open);
                iconOpen.classList.toggle('hidden', open);
                iconClose.classList.toggle('hidden', !open);
                if (open) {
                    if (!greeted) {
                        // Only mention WhatsApp when the channel is actually available,
                        // otherwise the greeting would point to a button that isn't shown.
                        bubble(waHref
                            ? 'Bonjour ! Comment souhaitez-vous être assisté ? Posez votre question à l\'assistant ci-dessous, ou contactez directement un conseiller Relief Services sur WhatsApp.'
                            : 'Bonjour ! Je suis l\'assistant Relief Services. Posez-moi une question sur nos services, un devis, une destination ou le suivi de votre dossier.',
                            'bot');
                        waCta('Contacter un conseiller sur WhatsApp'); // no-op when WhatsApp is off
                        greeted = true;
                    }
                    setTimeout(() => input.focus(), 50);
                }
            };
            window.rsChatOpen = function () { window.rsChatToggle(true); };

            window.rsChatSend = async function () {
                const q = (input.value || '').trim();
                if (!q || sending) return;
                input.value = ''; input.style.height = 'auto';
                bubble(q, 'user');
                sending = true;
                const t = typing();
                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf },
                        body: JSON.stringify({ question: q }),
                    });
                    t.remove();
                    if (res.status === 429) { bubble('Vous envoyez des messages trop vite — merci de patienter quelques instants.', 'bot'); input.value = q; }
                    else if (!res.ok) { bubble('Désolé, une erreur est survenue. Veuillez réessayer.', 'bot'); input.value = q; }
                    else {
                        const data = await res.json();
                        bubble(data.answer || 'Je n\'ai pas de réponse pour le moment.', 'bot');
                        // Escalate to a human when the assistant could not answer confidently.
                        if (data.status === 'needs_human_review' || data.status === 'failed') {
                            waCta('Contacter un conseiller sur WhatsApp');
                        }
                    }
                } catch (e) { t.remove(); bubble('Connexion impossible. Vérifiez votre réseau et réessayez.', 'bot'); input.value = q; }
                sending = false;
            };

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); window.rsChatSend(); }
            });
            input.addEventListener('input', function () { input.style.height = 'auto'; input.style.height = Math.min(input.scrollHeight, 112) + 'px'; });
        })();
    </script>
</div>
