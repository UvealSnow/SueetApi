<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    
	public function index ($id = null) {
		return view ('static.welcome');
	}

}
