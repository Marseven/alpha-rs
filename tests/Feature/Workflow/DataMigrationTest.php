<?php

namespace Tests\Feature\Workflow;

use App\Models\MedicalCaseWorkflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

class DataMigrationTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_backfill_creates_cases_from_existing_folders(): void
    {
        $owner = $this->makeUser();
        $f1 = $this->makeFolder($owner);
        $f2 = $this->makeFolder($owner);

        $this->artisan('workflow:backfill-cases')->assertSuccessful();

        $this->assertSame(2, MedicalCaseWorkflow::count());
        $case = MedicalCaseWorkflow::where('folder_id', $f1->id)->first();
        $this->assertNotNull($case);
        $this->assertSame('Jean Dupont', $case->patient_name);
        $this->assertSame($f1->phone, $case->patient_phone);
        $this->assertNotEmpty($case->tracking_number);
        $this->assertSame(MedicalCaseWorkflow::DRAFT, $case->status);
    }

    public function test_backfill_is_idempotent(): void
    {
        $owner = $this->makeUser();
        $this->makeFolder($owner);

        $this->artisan('workflow:backfill-cases');
        $this->artisan('workflow:backfill-cases'); // second run must not duplicate

        $this->assertSame(1, MedicalCaseWorkflow::count());
    }

    public function test_dry_run_writes_nothing(): void
    {
        $this->makeFolder($this->makeUser());

        $this->artisan('workflow:backfill-cases --dry-run')->assertSuccessful();

        $this->assertSame(0, MedicalCaseWorkflow::count());
    }

    public function test_set_role_command_assigns_workflow_role(): void
    {
        $user = $this->makeUser(['email' => 'doc@relief.test']);

        $this->artisan('users:set-role doc@relief.test doctor')->assertSuccessful();

        $this->assertSame('doctor', $user->fresh()->workflow_role);
    }

    public function test_set_role_command_rejects_invalid_role(): void
    {
        $this->makeUser(['email' => 'x@relief.test']);

        $this->artisan('users:set-role x@relief.test superuser')->assertFailed();
    }
}
