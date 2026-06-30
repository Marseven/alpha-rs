<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Additive, non-destructive: adds indexes on frequently filtered / joined
 * columns (foreign keys + status). Column TYPES are intentionally left
 * untouched (several are varchar/text); only safe indexes are added.
 *
 * Unique constraints on the pivot tables are deliberately NOT added here:
 * existing rows may contain duplicates, which would make the migration fail.
 * Deduplicate first, then add them in a follow-up (see HARDENING report).
 */
class AddMissingIndexes extends Migration
{
    /** table => [columns...] */
    private array $indexes = [
        'quotes' => ['user_id', 'service_id', 'status'],
        'folders' => ['user_id', 'service_id', 'status'],
        'payments' => ['customer_id', 'folder_id', 'quote_id', 'reference', 'status'],
        'towns' => ['country_id'],
        'hospital_sick' => ['hospital_id', 'sick_id'],
    ];

    public function up()
    {
        foreach ($this->indexes as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }
            Schema::table($table, function (Blueprint $t) use ($table, $columns) {
                foreach ($columns as $column) {
                    if (Schema::hasColumn($table, $column)) {
                        $t->index($column);
                    }
                }
            });
        }
    }

    public function down()
    {
        foreach ($this->indexes as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }
            Schema::table($table, function (Blueprint $t) use ($table, $columns) {
                foreach ($columns as $column) {
                    if (Schema::hasColumn($table, $column)) {
                        $t->dropIndex([$column]);
                    }
                }
            });
        }
    }
}
