<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedSmenas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('med_smenas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('status');
            $table->integer('user_id');
            $table->integer('med_service_id');
            $table->integer('patients_plan');
            $table->dateTime('started');
            $table->dateTime('stopped');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('med_smenas');
    }
}
