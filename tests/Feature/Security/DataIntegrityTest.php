<?php

namespace Tests\Feature\Security;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Health endpoint + soft-delete behaviour on business models.
 */
class DataIntegrityTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_health_endpoint_reports_ok(): void
    {
        $this->get('/up')
            ->assertOk()
            ->assertJson(['status' => 'ok', 'database' => 'ok']);
    }

    public function test_deleting_a_quote_is_soft(): void
    {
        $quote = $this->makeQuote($this->makeUser());

        $quote->delete();

        // Excluded from default queries…
        $this->assertSame(0, Quote::count());
        // …but still present (recoverable) with the deleted_at timestamp.
        $this->assertSoftDeleted('quotes', ['id' => $quote->id]);
        $this->assertSame(1, Quote::withTrashed()->count());
    }
}
