<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Simulators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('simulators', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->text('note')->nullable();
            $table->foreignId('simulator_item_id');
            $table->foreignId('country_id');
            $table->foreignId('sick_id');
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
        //
        Schema::dropIfExists('simulators');
    }
}
