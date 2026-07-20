<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * payments.reference is the key the payment webhook looks a charge up by, yet
 * it carried no uniqueness guarantee (only a plain index). Two rows sharing a
 * reference would make settlement ambiguous — the webhook settles whichever row
 * comes first.
 *
 * Guarded and non-destructive: if legacy duplicates exist the index is skipped
 * rather than failing the deploy, and the situation is reported so it can be
 * cleaned up deliberately.
 */
return new class extends Migration
{
    private const INDEX = 'payments_reference_unique';

    public function up(): void
    {
        if (! Schema::hasTable('payments') || ! Schema::hasColumn('payments', 'reference')) {
            return;
        }

        $duplicates = DB::table('payments')
            ->select('reference')
            ->whereNotNull('reference')
            ->groupBy('reference')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->count();

        if ($duplicates > 0) {
            echo "  ! payments.reference : {$duplicates} doublon(s) — index unique NON appliqué (à nettoyer manuellement)\n";

            return;
        }

        try {
            Schema::table('payments', function (Blueprint $table) {
                $table->unique('reference', self::INDEX);
            });
        } catch (\Throwable $e) {
            // Index already present, or the engine refused it: never fatal.
            echo "  ! payments.reference : index unique déjà présent ou refusé (" . $e->getMessage() . ")\n";
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('payments')) {
            return;
        }

        try {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropUnique(self::INDEX);
            });
        } catch (\Throwable $e) {
            // Nothing to drop.
        }
    }
};
