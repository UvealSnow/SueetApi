<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id');
            $table->integer('estate_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('resident_unit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resident_id');
            $table->integer('unit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
        Schema::dropIfExists('resident_unit');
    }
}
