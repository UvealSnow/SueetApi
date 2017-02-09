<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


// Model routes in alphabetical order
	
	// Estate routes
		Route::resource('estate/{estate_id}/section/{section_id}/unit', 'UnitApiController', ['except' => ['create', 'edit']]);
		Route::resource('estate/{id}/section', 'SectionController', ['except' => ['create', 'edit']]);
		Route::post('estate/{id}', 'EstateController@update');
		Route::resource('estate', 'EstateController', ['except' => ['create', 'edit', 'update']]);

	// Organisation routes
		Route::post('organisation/{id}', 'OrganisationController@update');
		Route::resource('organisation', 'OrganisationController', ['except' => ['create', 'store', 'edit']]); // tested