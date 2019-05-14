<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Arwa
        Schema::create('trainerSession', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('discription');
            $table->float('price');
            $table->float('priceForStudent');
            $table->float('priceForStaff');
            $table->string('currency');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->unsignedInteger('trainerId');
            $table->foreign('trainerId')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('facilityId');
            $table->foreign('facilityId')->references('id')->on('facility')->onDelete('cascade');
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
