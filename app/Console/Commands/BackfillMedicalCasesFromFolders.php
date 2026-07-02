<?php

namespace App\Console\Commands;

use App\Models\Folder;
use App\Models\MedicalCaseWorkflow;
use Illuminate\Console\Command;

/**
 * Data migration: turn existing medical folders into trackable workflow cases.
 * Idempotent — skips folders that already have a workflow case.
 *
 * Usage:
 *   php artisan workflow:backfill-cases            # create missing cases
 *   php artisan workflow:backfill-cases --dry-run  # report only, no writes
 */
class BackfillMedicalCasesFromFolders extends Command
{
    protected $signature = 'workflow:backfill-cases {--dry-run : Report what would be created without writing}';

    protected $description = 'Create a medical workflow case for each existing folder that does not have one';

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');
        $created = 0;
        $skipped = 0;

        foreach (Folder::query()->cursor() as $folder) {
            if (MedicalCaseWorkflow::where('folder_id', $folder->id)->exists()) {
                $skipped++;
                continue;
            }

            $name = trim(($folder->firstname ? $folder->firstname . ' ' : '') . $folder->lastname) ?: 'Patient';

            if ($dry) {
                $this->line("Would create case for folder #{$folder->id} ({$name})");
                $created++;
                continue;
            }

            MedicalCaseWorkflow::create([
                'folder_id' => $folder->id,
                'patient_name' => $name,
                'patient_phone' => $folder->phone,
                'doctor_id' => null,
                'cnamgs_id' => null,
                'status' => MedicalCaseWorkflow::DRAFT,
            ]);
            $created++;
        }

        $this->info(($dry ? '[DRY-RUN] ' : '') . "Cases created: {$created} — skipped (already existing): {$skipped}");

        return self::SUCCESS;
    }
}
