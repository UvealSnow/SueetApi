<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Application;
use App\Picture;
use App\Estate;
use App\Trace;

class ApplicationApiController extends Controller {
    

	public function __construct () {
		$this->middleware('auth:api');
	}

	public function index ($estate_id) {
		$user = Auth::user();
		$estate = Estate::findOrFail($estate_id);

		if ($user->can('view_all', $estate)) {
			return $estate->applications;
		}

		return response ('Not authorized', 403);
	}

	public function show ($application_id) {

		$user = Auth::user();
		$application = Application::findOrFail($application_id);

		if ($user->can('view', $application)) {
			$application->traces;
			return $application;
		}

		return response('Not authorized', 403);

	}

	public function store (Request $request) { # needs assigment of variables and save.

		$user = Auth::user();

		if ($user->can('create', App\Application::class)) {
			$this->validate($request, [
				'type' => 'required|string|in:access,mainteinance,delivery',
				'title' => 'required|string|max:255',
				'body' => 'required|string',
				'picture' -> 'image|max:2048'
			]);

			$app = new Application;
			$app->estate_id = $user->resident->estate_id; # this must be verified beforehand
			// $app->

		}

		return response ('Not authorized', 403);

	}

	public function answer (Request $request, $application_id) {

		$user = Auth::user();
		$application = Application::findOrFail($application_id);

		if ($user->can('answer', $application)) {
			$this->validate($request, [
				'body' => 'required|string',
				'picture' => 'image|max:2048',
			]);

			$trace = new Trace;
			$trace->user_id = $user->id;
			$trace->body = $request->body;
			$application->traces()->save($trace);

			if ($request->picture) {
				$pic = new Picture;
				$pic->path = $request->file('picture')->store("request/$application_id");
				$trace->pic()->save($pic);
			}

			$trace->picture;
			return $trace;

		}

		return response ('Not authorized', 403);

	}

	public function destroy ($application_id) {

		$user = Auth::user();
		$application = Application::findOrFail($application_id);

		if ($user->can('destroy', $application)) {
			$application->delete();
		}

		return response ('Not authorized', 403);

	}

}
