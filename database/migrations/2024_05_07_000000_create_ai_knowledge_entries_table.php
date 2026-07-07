<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('ai_knowledge_entries')) {
            Schema::create('ai_knowledge_entries', function (Blueprint $table) {
                $table->id();
                $table->string('question');
                $table->text('answer');
                $table->string('keywords')->nullable(); // mots-clés (séparés par des virgules/espaces) pour le matching direct
                $table->boolean('is_active')->default(true)->index();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_knowledge_entries');
    }
};
