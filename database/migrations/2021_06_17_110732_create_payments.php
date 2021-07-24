<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('folder_id')->nullable();
            $table->string('quote_id')->nullable();
            $table->text('description');
            $table->string('reference');
            $table->string('amount')->nullable();
            $table->string('status');
            $table->string('time_out');
            $table->text('operator')->nullable();
            $table->text('transaction_id')->nullable();
            $table->string('paid_at')->nullable();
            $table->string('expired_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
