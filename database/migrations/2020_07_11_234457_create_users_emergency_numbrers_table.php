<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersEmergencyNumbrersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_emergency_numbrers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default('0');
            $table->string('family_bond')->nullable();
            $table->string('surnames_names')->nullable();
            $table->string('phones')->nullable();
            $table->integer('created_by')->default('0');
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
        Schema::dropIfExists('users_emergency_numbrers');
    }
}
