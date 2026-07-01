<?php

namespace Tests\Feature\Security;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Health endpoint + delete behaviour on business models.
 *
 * NB: SoftDeletes is currently disabled on Quote/Folder/Payment because the
 * production host deploys via git-pull and cannot run the deleted_at migration
 * (see the models). Deletes are therefore hard deletes for now.
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

    public function test_deleting_a_quote_removes_it(): void
    {
        $quote = $this->makeQuote($this->makeUser());

        $quote->delete();

        $this->assertSame(0, Quote::count());
        $this->assertDatabaseMissing('quotes', ['id' => $quote->id]);
    }
}
