<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Estate;
use App\Section;
use App\Unit;

class UnitApiController extends Controller {

    public function __construct () {
        $this->middleware('auth:api');
    }

    # Currently not in use
    public function index($estate_id, $section_id) {

        $user = Auth::user();
        $estate = Estate::findOrFail($estate_id);
        $section = Section::findOrFail($section_id);

        if ($user->can('view_all', $estate, $section)) {
            return $section->units;
        }

        return response ('Not authorized', 401);
        
    }

    public function estateIndex ($estate_id) {
        $user = Auth::user();
        if ($user->can('estate_all', Unit::class)) {
            $estate = Estate::findOrFail($estate_id);
            return $estate->units;
        }
        return response ('Not authorized', 401);
    }

    public function estateSection ($section_id) {
        $user = Auth::user();
        if ($user->can('section_all', Unit::class)) {
            $section = \App\Section::findOrFail($section_id);
            return $section->units;
        }
        return response ('Not authorized', 401);
    }

    public function store(Request $request, $estate_id, $section_id) {
        
        $user = Auth::user();
        $estate = Estate::findOrFail($estate_id);
        $section = Section::findOrFail($section_id);

        if ($user->can('create', Unit::class)) { // add aditional classes

            $this->validate($request, [
                'number' => 'required|string|max:20',
            ]);

            $unit = new Unit;
            $unit->section_id = $section_id;
            $unit->number = $request->number;
            $unit->balance = 0;
            $unit->status = 'active';
            $unit->save();

            return $unit;

        }

        return response ('Not authorized', 401);

    }

    public function show($id) {
        
        $user = Auth::user();
        $unit = Unit::findOrFail($id);

        if ($user->can('view', $unit)) {
            return $unit;
        }

        return response ('Not authorized', 401);

    }

    public function update(Request $request, $id) {
        
        $user = Auth::user();
        $unit = Unit::findOrFail($id);

        if ($user->can('update', $unit)) {
            $this->validate($request, [
                'number' => 'required|string|max:20',
                'balance' => 'required|numeric|min:0',
                'status' => 'required|string',
            ]);

            $unit->section_id = $section_id;
            $unit->number = $request->number;
            $unit->balance = 0;
            $unit->status = 'active';
            $unit->save();

            return $unit;
        }

        return response ('Not authorized', 401);

    }

    public function destroy($id) {
        
        $user = Auth::user();
        $unit = Unit::findOrFail($id);

        if ($user->can('delete', $unit)) {
            $unit->delete();
            return response ('Deleted', 200);
        }

        return response ('Not authorized', 401);

    }
}
