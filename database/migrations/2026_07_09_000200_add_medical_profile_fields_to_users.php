<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Medical staff identity and account lifecycle.
 *
 * A "doctor" was only a users row with workflow_role='doctor': no specialty, no
 * institution, no professional number — and no way to cut off access, since the
 * only option was deleting the account, which orphans the cases they handled.
 *
 * Additive and guarded: existing rows keep working (all columns nullable).
 */
return new class extends Migration
{
    private const COLUMNS = [
        'specialty' => 'string',
        'institution' => 'string',
        'license_number' => 'string',
        'suspended_at' => 'timestamp',
    ];

    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            foreach (self::COLUMNS as $column => $type) {
                if (Schema::hasColumn('users', $column)) {
                    continue;
                }

                if ($type === 'timestamp') {
                    $table->timestamp($column)->nullable();
                } else {
                    $table->string($column)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            foreach (array_keys(self::COLUMNS) as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
