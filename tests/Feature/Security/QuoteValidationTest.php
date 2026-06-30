<?php

namespace Tests\Feature\Security;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * The quote request endpoint now validates input via a Form Request.
 */
class QuoteValidationTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_invalid_quote_submission_is_rejected_with_errors(): void
    {
        $response = $this->from('/quote')->post('/quote', []);

        $response->assertSessionHasErrors([
            'lastname', 'birthday', 'gender', 'email', 'phone', 'category',
            'service_id', 'country_id',
            'join_piece_passport', 'join_piece_rapport', 'join_piece_examen',
        ]);

        $this->assertSame(0, Quote::count());
    }
}
