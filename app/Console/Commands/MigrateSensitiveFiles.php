<?php

namespace App\Console\Commands;

use App\Models\Folder;
use App\Models\Quote;
use App\Services\SensitiveFileStorage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Moves legacy sensitive documents from public/upload/* into the private disk
 * (storage/app/private/*) and updates the model columns. Non-destructive by
 * default: the original public file is kept unless --delete is passed.
 */
class MigrateSensitiveFiles extends Command
{
    protected $signature = 'sensitive-files:migrate {--delete : Delete the original public file after a successful copy}';

    protected $description = 'Move legacy public documents (quotes/folders) to private storage';

    /** Model => [category, [columns...]] */
    private array $map = [
        Quote::class => ['quotes', ['join_piece_passport', 'join_piece_rapport', 'join_piece_exam', 'devis', 'join_piece']],
        Folder::class => ['documents', ['join_piece']],
    ];

    public function handle(): int
    {
        $moved = 0;
        $skipped = 0;
        $missing = 0;

        foreach ($this->map as $model => [$category, $columns]) {
            foreach ($model::query()->cursor() as $row) {
                foreach ($columns as $column) {
                    $value = $row->{$column} ?? null;

                    if (empty($value) || SensitiveFileStorage::isPrivate($value)) {
                        $skipped++;
                        continue;
                    }

                    $source = public_path(ltrim($value, '/'));
                    if (! is_file($source)) {
                        $this->warn("Missing file for {$model}#{$row->id} [{$column}]: {$value}");
                        $missing++;
                        continue;
                    }

                    $filename = basename($source);
                    $target = SensitiveFileStorage::ROOT . '/' . $category . '/' . $filename;
                    Storage::disk(SensitiveFileStorage::DISK)->put($target, file_get_contents($source));

                    $row->{$column} = $target;
                    $row->save();
                    $moved++;

                    if ($this->option('delete')) {
                        @unlink($source);
                    }
                }
            }
        }

        $this->info("Migration done — moved: {$moved}, skipped: {$skipped}, missing: {$missing}");
        $this->line('Originals ' . ($this->option('delete') ? 'were deleted.' : 'were kept (run with --delete to remove).'));

        return self::SUCCESS;
    }
}
