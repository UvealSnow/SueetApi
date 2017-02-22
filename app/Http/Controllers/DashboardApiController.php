<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardApiController extends Controller {
    
	public function __construct () {
		$this->middleware('auth:api');
	}

	public function dashboard () {

		$user = Auth::user();

		if ($user->organisation) {
			$organisation = $user->organisation;
			$organisation->estate_count = $organisation->estates->count();
			$organisation->unit_count = 0;
			$organisation->residents_count = 0;
			foreach ($organisation->estates as $estate) {
				$organisation->unit_count += $estate->units->count();
				foreach ($estate->units as $unit) {
					$organisation->residents_count += $unit->residents->count();
				}
			}
			$organisation->employee_count = $organisation->employees->count();

			return $organisation;
		}
	}

}
