<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('firstname')->nullable();
            $table->string('lastname');
            $table->string('birthday');
            $table->foreignId('gender');
            $table->string('email');
            $table->foreignId('phone');
            $table->foreignId('message');
            $table->foreignId('join_piece');
            $table->foreignId('country_id');
            $table->foreignId('service_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
