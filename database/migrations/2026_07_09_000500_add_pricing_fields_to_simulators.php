<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Structured pricing on the tariff catalog (simulators).
 *
 * Each grid row already is a line item (a poste + a free-text `value`) for a
 * (service, country, pathology) combination. To compute a real total we add a
 * numeric unit_price and a quantity, plus a category and optional/estimate
 * flags for the breakdown. `value` is kept as the human-readable label/fallback
 * so existing rows keep displaying. Additive and guarded.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('simulators')) {
            return;
        }

        Schema::table('simulators', function (Blueprint $table) {
            if (! Schema::hasColumn('simulators', 'unit_price')) {
                $table->decimal('unit_price', 14, 2)->nullable()->after('value');
            }
            if (! Schema::hasColumn('simulators', 'quantity')) {
                $table->decimal('quantity', 10, 2)->default(1)->after('unit_price');
            }
            if (! Schema::hasColumn('simulators', 'category')) {
                $table->string('category')->nullable()->after('quantity');
            }
            if (! Schema::hasColumn('simulators', 'is_optional')) {
                $table->boolean('is_optional')->default(false);
            }
            if (! Schema::hasColumn('simulators', 'is_estimate')) {
                $table->boolean('is_estimate')->default(true);
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('simulators')) {
            return;
        }

        Schema::table('simulators', function (Blueprint $table) {
            foreach (['unit_price', 'quantity', 'category', 'is_optional', 'is_estimate'] as $column) {
                if (Schema::hasColumn('simulators', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
