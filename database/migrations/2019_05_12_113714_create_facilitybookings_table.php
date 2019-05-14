<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitybookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Arwa
        Schema::create('facilityBookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('color');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->unsignedInteger('facilityId');
            $table->foreign('facilityId')->references('id')->on('facility')->onDelete('cascade');
           $table->unsignedInteger('userId');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
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
