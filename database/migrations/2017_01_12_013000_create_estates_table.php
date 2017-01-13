<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organisation_id');
            $table->integer('manager_id');
            $table->text('name');
            $table->text('type');
            $table->double('lat');
            $table->double('lng');
            $table->text('ext_number');
            $table->text('street');
            $table->text('district');
            $table->text('city');
            $table->text('state');
            $table->text('country');
            $table->text('img')->nullable();
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
        Schema::dropIfExists('estates');
    }
}
