<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Vehicle;
use App\Unit;
use App\Picture;

class VehicleApiController extends Controller {
    
	public function __construct () {
		$this->middleware('auth:api');
	}

	public function index ($unit_id) {
		$user = Auth::user();
		$unit = Unit::findOrFail($unit_id);
		if ($user->can('view_vehicles', $unit)) {
			return $unit->vehicles;
		}
		return response ('Not authorized', 401);
	}

	public function store (Request $request) {
		$user = Auth::user();
		if ($user->can('create', Vehicle::class)) {
			$this->validate($request, [
				'unit_id' => 'required|integer|exists:units,id',
				'model' => 'string|max:255',
				'brand' => 'string|max:255',
				'color' => 'string|max:255',
				'plates' => 'string|max:255',
				'image' => 'image|max:2048',
			]);

			$vehicle = new Vehicle;
			$vehicle->unit_id = $request->unit_id;
			$vehicle->model = $request->model;
			$vehicle->brand = $request->brand;
			$vehicle->color = $request->color;
			$vehicle->plates = $request->plates;
			$vehicle->save();

			if ($request->image != null) {
				$pic = new Pic;
				$pic->path = $request->file('image')->store('private/vehicles');
				$vehicle->picture()->save($pic);
			}	
			return $vehicle;
		}	
		return response ('Not authorized');
	}

	public function show ($id) {
		$user = Auth::user();
		$vehicle = Vehicle::findOrFail($id);
		if ($user->can('view', $vehicle)){
			return $vehicle;
		}
		return response ('Not authorized');
	}

	public function update (Request $request, $id) {
		$user = Auth::user();
		$vehicle = Vehicle::findOrFail($id);
		if ($user->can('create', $vehicle)) {
			$this->validate($request, [
				'model' => 'string|max:255',
				'brand' => 'string|max:255',
				'color' => 'string|max:255',
				'plates' => 'string|max:255',
				'image' => 'image|max:2048',
			]);

			$vehicle->model = $request->model;
			$vehicle->brand = $request->brand;
			$vehicle->color = $request->color;
			$vehicle->plates = $request->plates;
			$vehicle->save();
			
			if ($request->image != null) {
				if (!$vehicle->picture) $picture = new Picture;
				else {
					$pic = Picture::findOrFail($vehicle->picture->id);
					Storage::delete($pic->path);
				} 
				$pic->path = $request->file('image')->store('private/vehicles');
				$vehicle->picture()->save($pic);
			}	
			return $vehicle;
		}	
		return response ('Not authorized');
	}

	public function destroy ($id) {
		$user = Auth::user();
		$vehicle = Vehicle::findOrFail($id);
		if ($user->can('delete', $vehicle)) {
			$vehicle->delete();
			return response ('Deleted', 200);
		}
		return response ('Not authorized', 401);
	}

}
