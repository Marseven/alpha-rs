<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('ai_questions')) {
            Schema::create('ai_questions', function (Blueprint $t) {
                $t->id();
                $t->string('name')->nullable();
                $t->string('phone')->nullable();
                $t->string('email')->nullable();
                $t->text('question');
                $t->text('answer')->nullable();
                $t->text('source_context')->nullable();
                $t->string('status')->default('answered')->index(); // answered|failed|needs_human_review
                $t->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_questions');
    }
};
