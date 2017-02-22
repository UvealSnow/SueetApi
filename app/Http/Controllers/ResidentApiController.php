<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Estate;
use App\Resident;

class ResidentApiController extends Controller {
    
	public function __construct () {
		$this->middleware('auth:api');
	}

	public function index ($estate_id) {

		$user =  Auth::user();
		$estate = Estate::findOrFail($estate_id);

		if ($user->can('view_all', $estate)) {
			foreach ($estate->residents as $resident) {
				$resident->user;
			}
			return $estate->residents;
		}

		return response ('Not authorized', 403);

	}

}
