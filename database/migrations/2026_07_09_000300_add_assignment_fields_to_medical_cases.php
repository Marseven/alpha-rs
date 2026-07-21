<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Third-party assignment + deadlines on medical cases.
 *
 * The doctor still creates their own cases, but Relief Services can now also
 * assign/reassign a case to a doctor and set a processing deadline. Additive
 * and guarded — existing rows are unaffected (both columns nullable).
 */
return new class extends Migration
{
    private const COLUMNS = ['due_at', 'assigned_at'];

    public function up(): void
    {
        if (! Schema::hasTable('medical_case_workflows')) {
            return;
        }

        Schema::table('medical_case_workflows', function (Blueprint $table) {
            if (! Schema::hasColumn('medical_case_workflows', 'due_at')) {
                $table->timestamp('due_at')->nullable()->index();
            }
            if (! Schema::hasColumn('medical_case_workflows', 'assigned_at')) {
                $table->timestamp('assigned_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('medical_case_workflows')) {
            return;
        }

        Schema::table('medical_case_workflows', function (Blueprint $table) {
            foreach (self::COLUMNS as $column) {
                if (Schema::hasColumn('medical_case_workflows', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
