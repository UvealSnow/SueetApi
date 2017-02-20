<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Organisation;

class OrganisationApiController extends Controller {
    
    public function __construct () {
        $this->middleware('auth:api');
    }

    public function index() {
        
        $user = Auth::user();
        if ($user->organisation) {
            # probably going to need to edit some info here
            $organisation = $user->organisation;
            $organisation->estates;
            return $organisation;
        }
        elseif ($user->employee) {
            $organisation = $user->employee->organisation; # organisation he works on
            $organisation->estates = $user->employee->estates; # Buildings he is enrolled in
            return $organsiation;
        }
        elseif ($user->resident) {
            $organisation = $user->resident->estate->organisation;
            $organisation->estates = $user->resident->estate;
            return $organsiation;
        }
        return response('Not authorized', 401);

    }

    public function show($id) {
        
        $user = Auth::user();
        $organisation = Organisation::findOrFail($id);

        if  ($user->can('view', $organisation)) {

            $organisation->estates;
            $organisation->manager;
            if ($organisation->picture != null) $organisation->picture = Storage::url($organisation->picture->path);

            return $organisation;

        }

        return response('Not authorized', 401);

    }

    public function update(Request $request, $id) {
        
        $user = Auth::user();
        $organisation = Organisation::find($id);

        if  ($user->can('update', $organisation)) { 

            $this->validate($request, [
                'name' => 'string',
                'state' => 'string',
                'img' => 'image|max:2048'
            ]);

            if ($request->name != null) $organisation->name = $request->name;
            if ($request->img != null) {
                if ($organisation->picture && Storage::exists($organisation->picture->path)) Storage::delete($organisation->picture->path);
                $organisation->picture = $request->file('img')->store("public/organisation/$organisation->id");
            }
            if ($request->state != null) $organisation->state = $request->state;
            $organisation->save();
            return $organisation;

        }

        return response('Not authorized', 401);

    }

    public function dashboard () {
        // to do
    }

}
