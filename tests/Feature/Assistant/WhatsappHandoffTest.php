<?php

namespace Tests\Feature\Assistant;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * The assistance widget offers a WhatsApp handoff (cahier §8): a wa.me link with
 * a fixed, PII-free prefilled message, configurable, and hideable.
 */
class WhatsappHandoffTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_renders_the_whatsapp_handoff_link(): void
    {
        config(['relief.whatsapp.enabled' => true, 'relief.whatsapp.number' => '24176555781']);

        $this->get('/')
            ->assertOk()
            ->assertSee('wa.me/24176555781', false);
    }

    public function test_the_prefilled_message_carries_no_medical_or_personal_data(): void
    {
        config(['relief.whatsapp.enabled' => true, 'relief.whatsapp.number' => '24176555781']);

        $html = $this->get('/')->getContent();

        // The message is fixed and generic — no diagnosis, patient name, or dossier content.
        preg_match_all('#wa\.me/24176555781\?text=([^"\'&\s]+)#', $html, $m);
        $this->assertNotEmpty($m[1], 'expected a wa.me link with a prefilled message');
        foreach ($m[1] as $encoded) {
            $decoded = mb_strtolower(rawurldecode($encoded));
            foreach (['diagnostic', 'maladie', 'pathologie', 'traitement', 'passeport', 'dossier n'] as $forbidden) {
                $this->assertStringNotContainsString($forbidden, $decoded);
            }
        }
    }

    public function test_the_handoff_can_be_disabled_by_config(): void
    {
        config(['relief.whatsapp.enabled' => false]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('wa.me/', false);
    }

    public function test_the_number_falls_back_to_the_contact_phone(): void
    {
        config([
            'relief.whatsapp.enabled' => true,
            'relief.whatsapp.number' => null,
            'relief.contact_phone' => '+241 66 20 75 25',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('wa.me/24166207525', false); // digits only
    }
}
