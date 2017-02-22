<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estate_id');
            $table->string('name');
            $table->string('start_date');
            $table->string('charge_every');
            $table->double('standard_amount');
            $table->boolean('unique');
            $table->timestamps();
        });  

        Schema::create('fee_unit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fee_id');
            $table->integer('unit_id');
            $table->double('special_amount')->nullable()->default(null);
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
