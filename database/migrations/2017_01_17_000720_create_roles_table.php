<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('access')->default(false); // employee has access to scoped estates access requests
            $table->boolean('amenities')->default(false); // employee can manage amenities in scoped estates and their reservations
            $table->boolean('create_estates')->default(false); // allows employee to create new estates in his organisation
            $table->boolean('documents')->default(false); // employee has access to scoped estates docuements and forlders
            $table->boolean('edit_estates')->default(false); // allows employee to edit scoped estates
            $table->boolean('edit_organisation')->default(false); // allows employee to edit his organisation information
            $table->boolean('employees')->default(false); // employee can CRUD employees for his organisation
            $table->boolean('events')->default(false); // employee has access to scoped estates event calendar
            $table->boolean('fees')->default(false); // employee has access to scoped estates fee administration
            $table->boolean('mainteinance')->default(false); // employee has access to scoped estates mainteinance requests
            $table->boolean('messages')->default(false); // employee can send and recieve messages, can be added to groups
            $table->boolean('payments')->default(false); // employee has acces to scoped estates payment logs
            $table->boolean('polls')->default(false); // employee has access to scoped estates poll creation and answer
            $table->boolean('residents')->default(false); // employee has access to scoped estates resident editing
            $table->boolean('roles')->default(false);  // employee has access to scoped estates role creation and editing
            $table->boolean('units')->default(false); // employee has access to scoped estates units (pets, vehicles) and observations
            $table->timestamps();
        });

        Schema::create('employee_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('role_id');
            $table->integer('estate_id');
        });

        Schema::table('employee_estate', function (Blueprint $table) {
            $table->integer('role_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');

        Schema::dropIfExists('employee_role');

        Schema::table('employee_estate', function (Blueprint $table) {
            $table->dropColumn('role_id');
        });

    }
}
