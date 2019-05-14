<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('discription');
            $table->float('price');
            $table->float('priceForStudent');
            $table->float('priceForStaff');
            $table->string('currency');
            $table->string('location');
             $table->integer('maximumCapacity');
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
