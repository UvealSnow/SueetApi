<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('desc')->nullable();
            $table->integer('pictureable_id');
            $table->string('pictureable_type');
            $table->timestamps();
        });

        Schema::table('organisations', function (Blueprint $table) {
            $table->dropColumn('img');
        });

        Schema::table('estates', function (Blueprint $table) {
            $table->dropColumn('img');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
