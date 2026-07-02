<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Correct the medical workflow vocabulary: the second actor is the CNAMGS
 * (the national health-insurance fund that approves an evacuation), NOT a
 * "pharmacy". Renames the columns, the stored status values and the workflow
 * role that were mislabelled.
 *
 * Idempotent and guarded: on a fresh install (columns already created as
 * cnamgs_*) every step is a no-op, so it is safe to run in any environment.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('medical_case_workflows')) {
            Schema::table('medical_case_workflows', function (Blueprint $t) {
                if (Schema::hasColumn('medical_case_workflows', 'pharmacy_id') && ! Schema::hasColumn('medical_case_workflows', 'cnamgs_id')) {
                    $t->renameColumn('pharmacy_id', 'cnamgs_id');
                }
                if (Schema::hasColumn('medical_case_workflows', 'pharmacy_note') && ! Schema::hasColumn('medical_case_workflows', 'cnamgs_note')) {
                    $t->renameColumn('pharmacy_note', 'cnamgs_note');
                }
                if (Schema::hasColumn('medical_case_workflows', 'sent_to_pharmacy_at') && ! Schema::hasColumn('medical_case_workflows', 'sent_to_cnamgs_at')) {
                    $t->renameColumn('sent_to_pharmacy_at', 'sent_to_cnamgs_at');
                }
                if (Schema::hasColumn('medical_case_workflows', 'received_by_pharmacy_at') && ! Schema::hasColumn('medical_case_workflows', 'received_by_cnamgs_at')) {
                    $t->renameColumn('received_by_pharmacy_at', 'received_by_cnamgs_at');
                }
            });

            // Stored status values (only touches legacy rows).
            DB::table('medical_case_workflows')->where('status', 'sent_to_pharmacy')->update(['status' => 'sent_to_cnamgs']);
            DB::table('medical_case_workflows')->where('status', 'received_by_pharmacy')->update(['status' => 'received_by_cnamgs']);
        }

        // Workflow role value on users.
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'workflow_role')) {
            DB::table('users')->where('workflow_role', 'pharmacy')->update(['workflow_role' => 'cnamgs']);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('medical_case_workflows')) {
            Schema::table('medical_case_workflows', function (Blueprint $t) {
                if (Schema::hasColumn('medical_case_workflows', 'cnamgs_id') && ! Schema::hasColumn('medical_case_workflows', 'pharmacy_id')) {
                    $t->renameColumn('cnamgs_id', 'pharmacy_id');
                }
                if (Schema::hasColumn('medical_case_workflows', 'cnamgs_note') && ! Schema::hasColumn('medical_case_workflows', 'pharmacy_note')) {
                    $t->renameColumn('cnamgs_note', 'pharmacy_note');
                }
                if (Schema::hasColumn('medical_case_workflows', 'sent_to_cnamgs_at') && ! Schema::hasColumn('medical_case_workflows', 'sent_to_pharmacy_at')) {
                    $t->renameColumn('sent_to_cnamgs_at', 'sent_to_pharmacy_at');
                }
                if (Schema::hasColumn('medical_case_workflows', 'received_by_cnamgs_at') && ! Schema::hasColumn('medical_case_workflows', 'received_by_pharmacy_at')) {
                    $t->renameColumn('received_by_cnamgs_at', 'received_by_pharmacy_at');
                }
            });

            DB::table('medical_case_workflows')->where('status', 'sent_to_cnamgs')->update(['status' => 'sent_to_pharmacy']);
            DB::table('medical_case_workflows')->where('status', 'received_by_cnamgs')->update(['status' => 'received_by_pharmacy']);
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'workflow_role')) {
            DB::table('users')->where('workflow_role', 'cnamgs')->update(['workflow_role' => 'pharmacy']);
        }
    }
};
