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
            $table->string('reference')->unique();
            $table->string('category');
            $table->string('firstname')->nullable();
            $table->string('lastname');
            $table->string('birthday');
            $table->char('gender');
            $table->string('email');
            $table->string('phone');
            $table->string('join_piece');
            $table->foreignId('country_id');
            $table->foreignId('town_id')->nullable();
            $table->foreignId('service_id');
            $table->foreignId('user_id');
            $table->string('devis')->nullable();
            $table->string('response')->nullable();
            $table->string('status');
            $table->boolean('folder')->default(false);
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
