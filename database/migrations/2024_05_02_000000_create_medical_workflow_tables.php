<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Medical case workflow (doctor -> CNAMGS/pharmacy -> patient).
 * Additive and defensive: guarded so it can run against the existing DB.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Lightweight workflow role on users (compatible with the existing
        // security_role_id + role() relationship — hence NOT named "role").
        if (Schema::hasTable('users') && ! Schema::hasColumn('users', 'workflow_role')) {
            Schema::table('users', function (Blueprint $t) {
                $t->string('workflow_role')->nullable()->index()->after('security_role_id'); // doctor|pharmacy|admin
            });
        }

        if (! Schema::hasTable('medical_case_workflows')) {
            Schema::create('medical_case_workflows', function (Blueprint $t) {
                $t->id();
                $t->string('tracking_number')->unique();
                $t->unsignedBigInteger('folder_id')->nullable()->index();
                $t->string('patient_name');
                $t->string('patient_phone')->nullable()->index();
                $t->unsignedBigInteger('doctor_id')->nullable()->index();
                $t->unsignedBigInteger('pharmacy_id')->nullable()->index();
                $t->string('status')->default('draft')->index();
                $t->text('doctor_note')->nullable();
                $t->text('pharmacy_note')->nullable();
                $t->text('patient_note')->nullable();
                $t->timestamp('sent_to_pharmacy_at')->nullable();
                $t->timestamp('received_by_pharmacy_at')->nullable();
                $t->timestamp('processed_at')->nullable();
                $t->timestamp('completed_at')->nullable();
                $t->timestamps();
            });
        }

        if (! Schema::hasTable('medical_case_status_histories')) {
            Schema::create('medical_case_status_histories', function (Blueprint $t) {
                $t->id();
                $t->unsignedBigInteger('medical_case_workflow_id')->index();
                $t->string('old_status')->nullable();
                $t->string('new_status');
                $t->unsignedBigInteger('changed_by')->nullable();
                $t->text('note')->nullable();
                $t->timestamps();
            });
        }

        if (! Schema::hasTable('case_notifications')) {
            Schema::create('case_notifications', function (Blueprint $t) {
                $t->id();
                $t->unsignedBigInteger('medical_case_workflow_id')->index();
                $t->string('channel');   // email|sms|whatsapp
                $t->string('recipient')->nullable();
                $t->text('message')->nullable();
                $t->string('status')->default('pending'); // pending|sent|failed
                $t->timestamp('sent_at')->nullable();
                $t->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('case_notifications');
        Schema::dropIfExists('medical_case_status_histories');
        Schema::dropIfExists('medical_case_workflows');
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'workflow_role')) {
            Schema::table('users', function (Blueprint $t) {
                $t->dropColumn('workflow_role');
            });
        }
    }
};
