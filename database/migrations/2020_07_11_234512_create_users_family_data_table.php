<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersFamilyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_family_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default('0');
            $table->string('family_bond')->nullable();
            $table->string('surnames_names')->nullable();
            $table->string('age')->nullable();
            $table->string('dni')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('social_networks')->nullable();
            $table->string('medical_information')->nullable();
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
        Schema::dropIfExists('users_family_data');
    }
}
