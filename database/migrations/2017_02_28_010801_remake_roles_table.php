<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemakeRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::dropIfExists('roles');

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('dashboard')->default(false);
            $table->boolean('view_estate')->default(false);
            $table->boolean('create_estate')->default(false);
            $table->boolean('edit_estate')->default(false);
            $table->boolean('delete_estate')->default(false);
            $table->boolean('view_unit')->default(false);
            $table->boolean('create_unit')->default(false); // more like invite
            $table->boolean('edit_unit')->default(false);
            $table->boolean('delete_unit')->default(false);
            $table->boolean('view_resident')->default(false);
            $table->boolean('create_resident')->default(false); // more like invite
            $table->boolean('edit_resident')->default(false);
            $table->boolean('delete_resident')->default(false);
            $table->boolean('view_communication')->default(false);
            $table->boolean('create_communication')->default(false);
            $table->boolean('edit_communication')->default(false);
            $table->boolean('delete_communication')->default(false);
            $table->boolean('view_request_mainteinance')->default(false);
            $table->boolean('view_request_delivery')->default(false);
            $table->boolean('view_request_access')->default(false);
            $table->boolean('edit_request')->default(false);
            $table->boolean('delete_request')->default(false);
            $table->boolean('view_fee')->default(false);
            $table->boolean('create_fee')->default(false);
            $table->boolean('edit_fee')->default(false);
            $table->boolean('delete_fee')->default(false);
            $table->boolean('view_amenity')->default(false);
            $table->boolean('create_amenity')->default(false);
            $table->boolean('edit_amenity')->default(false);
            $table->boolean('delete_amenity')->default(false);
            $table->boolean('view_employee')->default(false);
            $table->boolean('create_employee')->default(false);
            $table->boolean('edit_employee')->default(false);
            $table->boolean('delete_employee')->default(false);
            $table->boolean('view_calendar')->default(false);
            $table->boolean('create_calendar')->default(false);
            $table->boolean('edit_calendar')->default(false);
            $table->boolean('delete_calendar')->default(false);
            $table->boolean('view_document')->default(false);
            $table->boolean('create_document')->default(false);
            $table->boolean('edit_document')->default(false);
            $table->boolean('delete_document')->default(false);
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            //
        });
    }
}
