<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organisation_id');
            $table->integer('user_id');
            $table->text('status');
            $table->timestamps();
        });

        Schema::create('employee_estate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('estate_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employee_estate');
    }
}
