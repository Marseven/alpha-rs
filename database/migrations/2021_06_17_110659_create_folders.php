<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('category');
            $table->string('firstname')->nullable();
            $table->string('lastname');
            $table->string('birthday');
            $table->char('gender');
            $table->string('email');
            $table->string('phone');
            $table->double('price')->nullable();
            $table->string('join_piece');
            $table->foreignId('country_id');
            $table->foreignId('town_id')->nullable();
            $table->foreignId('service_id');
            $table->foreignId('user_id');
            $table->string('status');
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
        Schema::dropIfExists('folders');
    }
}
