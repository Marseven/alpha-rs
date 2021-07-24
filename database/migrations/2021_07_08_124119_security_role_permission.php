<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SecurityRolePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('security_role_permission', function (Blueprint $table) {
            $table->id();
            $table->string('security_role_id');
            $table->string('security_permission_id');
            $table->string('look')->nullable();
            $table->string('creat')->nullable();
            $table->string('updat')->nullable();
            $table->string('del')->nullable();
            $table->foreignId('user_id')->nullable();
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
    }
}
