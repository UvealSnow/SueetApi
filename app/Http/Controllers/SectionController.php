<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Estate;
use App\Section;

class SectionController extends Controller {
    
        public function __construct () {
        $this->middleware('auth:api');
    }


    public function index($estate_id) {
        
        $user = Auth::user();
        $estate = Estate::find($estate_id);

        if ($user->can('view_all', $estate, Section::class)) {
            return $estate->sections;
        }

        return response ('Not authorized', 401);

    }

    public function store(Request $request, $estate_id) {
        
        $user = Auth::user();
        $estate = Estate::findOrFail($estate_id);

        $this->validate($request, [
            'manager_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'img' => 'required|image|max:2048',
        ]);

        if ($user->can('create', Section::class)) {
            $section = new Section;
            $section->manager_id = $request->manager_id;
            $section->name = $request->name;
            $section->img = $request->file('img')->store("public/estates/$estate_id/sections");
            $section->save();
            return $section;
        }
        return response ('Not authorized', 401);

    }

    public function show($estate_id, $id) {
        
        $user = Auth::user();
        $estate = Estate::findOrFail($estate_id);
        $section = Section::findOrFail($id);

        if ($user->can('view', $estate, $section)) {
            return $section;
        }
        return response ('Not authorized', 401);

    }

    public function update(Request $request, $estate_id, $id) {
        
        $user = Auth::user();
        $estate = Estate::findOrFail($estate_id);
        $section = Section::findOrFail($id);

        $this->validate($request, [
            'manager_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'img' => 'image|max:2048',
        ]);

        if ($user->can('update', $estate, $section)) {
            $section->manager_id = $request->manager_id;
            $section->name = $request->name;
            if ($request->img != null) {
                Storage::delete($section->img);
                $section->img = $request->file('img')->store("public/estates/$estate_id/sections");
            }
            $section->save();
        }
        return response ('Not authorized', 401);

    }

    public function destroy($estate_id, $id) {
        
        $user = Auth::user();
        $estate = Estate::findOrFail($estate_id);
        $section = Section::findOrFail($id);

        if ($user->can('delete', $estate, $section)) {
            $section->delete();
            return response ('Deleted', 200);
        }
        return response ('Not authorized', 401);

    }
}
