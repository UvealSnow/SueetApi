<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Pet;
use App\Unit;
use App\Picture;

class PetApiController extends Controller {
    
	public function __construct () {
		$this->middleware('auth:api');
	}

	public function index ($unit_id) {
		$user = Auth::user();
		$unit = Unit::findOrFail($unit_id);
		if ($user->can('view_pets', $unit)) {
			return $unit->pets;
		}
		return response ('Not authorized', 401);
	}

	public function store (Request $request) {
		$user = Auth::user();
		if ($user->can('create', Pet::class)) {
			$this->validate($request, [
				'unit_id' => 'required|integer|exists:units,id',
				'name' => 'string|max:255',
				'species' => 'string|max:255',
				'sex' => 'string|in:male,female',
				'details' => 'string',
				'image' => 'image|max:2048',
			]);

			$pet = new Pet;
			$pet->unit_id = $request->unit_id;
			$pet->name = $request->name;
			$pet->species = $request->species;
			$pet->sex = $request->sex;
			$pet->details = $request->details;
			$pet->save();

			if ($request->image != null) {
				$pic = new Picture;
				$pic->path = $request->file('image')->store('private/pets');
				$pet->picture()->save($pic);
			}

			return $pet;
		}
		return response ('Not authorized', 401);
	} 

	public function show ($id) {
		$user = Auth::user();
		$pet = Pet::findOrFail($id);
		if ($user->can('view', $pet)) {
			return $pet;
		}
		return response ('Not authorized', 401);
	}

	public function update (Request $request, $id) {
		$user = Auth::user();
		$pet = Pet::findOrFail($id);
		if ($user->can('update', $pet)) {
			$this->validate($request, [
				'unit_id' => 'required|integer|exists:units,id',
				'name' => 'string|max:255',
				'species' => 'string|max:255',
				'sex' => 'string|in:male,female',
				'details' => 'string',
				'image' => 'image|max:2048',
			]);

			$pet->unit_id = $request->unit_id;
			$pet->name = $request->name;
			$pet->species = $request->species;
			$pet->sex = $request->sex;
			$pet->details = $request->details;
			$pet->save();

			if ($request->image != null) {
				if (!$pet->picture) $picture = new Picture;
				else {
					$pic = Picture::findOrFail($pet->picture->id);
					Storage::delete($pic->path);
				} 
				$pic->path = $request->file('image')->store('private/pets');
				$pet->picture()->save($pic);
			}

			return $pet;
		}
		return response ('Not authorized', 401);
	}

	public function destroy ($id) {
		$user = Auth::user();
		$pet = Pet::findOrFail($id);
		if ($user->can('delete', $pet)) {
			$pet->delete();
			return response ('Deleted', 200);
		}
		return responde ('Not authorized');
	}

}
