<?php

	/*
	* 	Api routes for the server
	*	Tags:
	*	(to do) - Work in progress
	*	(not tested) - Pls test?
	*	(bugged) - Something is wrong ->spreadsheet
	* 	(modify) - Something needs changes -> spreadsheet
	*	(final) - Marks route as tested and true
	*
	*	Syntax: Route::verb('url/{param}', 'Controller@function');
	*/

	// Special routes
		// Dashboard
		Route::get('dashboard', 'DashboardApiController@dashboard');

		// Estates
		Route::get('section/{section_id}/unit', 'UnitApiController@estateSection'); # Gets all the units from given estates' section
		Route::get('estate/{estate_id}/section', 'SectionApiController@index'); # Gets all the sections from given estate
		Route::get('estate/{estate_id}/unit', 'UnitApiController@estateIndex'); # Gets all the units from given estate
		Route::get('estate/{estate_id}/employee', 'TodoApiController@todo'); # (to do) Gets all the employees from given estate
 		Route::get('estate/{estate_id}/resident', 'TodoApiController@todo'); # (to do) Gets all the employees from given estate
 		Route::get('estate/{estate_id}/application', 'ApplicationApiController@index'); # (to do) Gets all the applications from given estate
 		Route::get('estate/{estate_id}/fee', 'FeeApiController@index');

		// Units
		Route::get('unit/{unit_id}/pet', 'PetApiController@index'); # (not tested) Gets all the pets of a particular unit
		Route::get('unit/{unit_id}/vehicle', 'VehicleApiController@index'); # (to do) Gets all the vehicles of a particular unit
		Route::get('unit/{unit_id}/payment', 'PaymentApiController@index'); # (to do) Gets all the payments of a particular unit
		Route::get('unit/{unit_id}/observation', 'ObservationApiController@index'); # (to do) Gets all the observations of a particular unit
 		Route::get('unit/{unit_id}/observation/{observation_id}', 'ObservationApiController@show'); # (to do) Gets specified observation of particular unit

 		// Organisation
		Route::get('organisation/dashboard', 'OrganisationApiController@dashboard'); # (to do) Gets the organisation dashboard data

	// Organisation routes
		Route::get('organisation', 'OrganisationApiController@index'); # Gets users' organisation
		Route::get('organisation/{id}', 'OrganisationApiController@show'); # Gets shows a specified organisation
 		Route::post('organisation/{id}', 'OrganisationApiController@update'); # not tested) Edits a given organisation

	// Estate routes
		Route::get('estate', 'EstateApiController@index'); # Gets all the estates of the users' organisation
		Route::get('estate/{estate_id}', 'EstateApiController@show'); # Gets specified estate
		Route::post('estate', 'EstateApiController@store'); # (not tested) Creates a new estate
		Route::post('estate/{estate_id}', 'EstateApiController@show'); # (not tested) Edits a specified estate
 		Route::delete('estate/{estate_id}', 'EstateApiController@destroy'); # (not tested) Deletes a specified estate and cascades to all dependent relations

	// Section routes
		Route::get('section/{id}', 'SectionApiController@show'); # Gets specified section
		Route::post('section', 'SectionApiController@store'); # (not tested) Creates a new section
		Route::post('section/{id}', 'SectionApiController@update'); # (not tested) Edits a specified section 
 		Route::delete('section/{id}', 'SectionApiController@destroy'); # (not tested) Deletes a specified section and cascades to all dependent relations

	// Unit routes
		Route::get('unit/{id}', 'UnitApiController@show'); # Gets specified unit
		Route::post('unit/{id}', 'UnitApiController@update'); # (not tested) Edits a specified unit 
		Route::delete('unit/{id}', 'UnitApiController@destroy'); # (not tested) Deletes a specified unit and cascades to all dependent relations

	// Pet routes
		Route::get('pet/{id}', 'PetApiController@show'); # Gets specified pet
		Route::post('pet', 'PetApiController@store'); # Creates a new pet
		Route::post('pet/{id}', 'PetApiController@update'); # Updates specified pet
		Route::delete('pet/{id}', 'PetApiController@destroy'); # Deletes pet

	// Vehicle routes
		Route::get('vehicle/{id}', 'VehicleApiController@show'); # Gets specified vehicle
		Route::post('vehicle', 'VehicleApiController@store'); # Creates a new vehicle
		Route::post('vehicle/{id}', 'VehicleApiController@update'); # Updates specified vehicle
		Route::delete('vehicle/{id}', 'VehicleApiController@destroy'); # Deletes vehicle

	// Document
		Route::get('document/{id}', 'DocumentApiController@show'); # (to do) Shows the selected document
		Route::post('document', 'DocumentApiController@store'); # (to do)
		Route::delete('document/{id}', 'DocumentApiController@destroy'); # (to do)

	// Application
		Route::get('application/{id}', 'ApplicationApiController@show');
		Route::post('application', 'ApplicationApiController@store');
		Route::delete('application/{id}', 'ApplicationApiController@destroy');

	// Trace
		Route::get('trace/{id}', 'TraceApiController@show');

	// 

