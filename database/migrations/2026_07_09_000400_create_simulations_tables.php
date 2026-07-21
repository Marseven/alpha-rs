<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Structured, persisted simulations.
 *
 * The existing `simulators` grid is only a lookup catalog (a free-text `value`
 * per poste) and nothing is ever saved when a visitor runs a simulation. These
 * two tables store an actual computed estimate — a header with its total and a
 * breakdown of lines (quantity x unit price) — so it can be retrieved, attached
 * to a folder, exported or e-mailed, with the tariff version frozen at compute
 * time. Additive and guarded: the legacy grid is untouched.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('simulations')) {
            Schema::create('simulations', function (Blueprint $t) {
                $t->id();
                $t->string('reference')->unique();
                // Inputs (kept as plain ids — no FK constraint, matching the
                // rest of this legacy schema which avoids hard FKs).
                $t->unsignedBigInteger('service_id')->nullable()->index();
                $t->unsignedBigInteger('country_id')->nullable()->index();
                $t->unsignedBigInteger('sick_id')->nullable()->index();
                // Ownership / association (all optional: guests can simulate).
                $t->unsignedBigInteger('user_id')->nullable()->index();
                $t->unsignedBigInteger('folder_id')->nullable()->index();
                // Contact for a guest simulation / e-mail delivery.
                $t->string('contact_name')->nullable();
                $t->string('contact_email')->nullable();
                $t->string('contact_phone')->nullable();
                // Money.
                $t->decimal('total', 14, 2)->default(0);
                $t->string('currency', 8)->default('XAF');
                // Tariff snapshot metadata.
                $t->string('tariff_version')->nullable();
                $t->date('valid_until')->nullable();
                $t->string('status')->default('draft')->index();
                $t->timestamps();
            });
        }

        if (! Schema::hasTable('simulation_lines')) {
            Schema::create('simulation_lines', function (Blueprint $t) {
                $t->id();
                $t->unsignedBigInteger('simulation_id')->index();
                $t->string('category')->nullable();
                $t->string('label');
                $t->decimal('quantity', 10, 2)->default(1);
                $t->decimal('unit_price', 14, 2)->default(0);
                $t->decimal('amount', 14, 2)->default(0); // quantity * unit_price, stored for integrity
                $t->boolean('is_optional')->default(false);
                $t->boolean('is_estimate')->default(true);
                $t->unsignedBigInteger('source_simulator_id')->nullable(); // provenance in the catalog
                $t->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('simulation_lines');
        Schema::dropIfExists('simulations');
    }
};
