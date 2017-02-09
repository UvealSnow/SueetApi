<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Organisation;

class OrganisationController extends Controller {
    
    public function __construct () {
        $this->middleware('auth:api');
    }

    public function index() {
        
        $user = Auth::user();
        if ($user->organisation) return $user->organisation;
        elseif ($user->residents) return $user->residents[0]->estate->organisation;

    }

    public function show($id) {
        
        $user = Auth::user();
        $organisation = Organisation::find($id);

        if  ($user->can('view', $organisation)) {

            $organisation->estates;
            $organisation->manager;
            $organisation->img = Storage::url($organisation->img);

            return $organisation;

        }

        return response('Not authorized', 401);

    }

    public function update(Request $request, $id) {
        
        $user = Auth::user();
        $organisation = Organisation::find($id);

        if  ($user->can('update', $organisation)) { 

            $this->validate($request, [
                'name' => 'required|string',
                'state' => 'required|string',
                'img' => 'required|image|max:2048'
            ]);

            if ($request->name != null) $organisation->name = $request->name;
            // if ($request->img != null) $organisation->img = $request->file('img')->store('public/organisations');
            if ($request->state != null) $organisation->state = $request->state;

            $organisation->save();

            return $organisation;

        }

        return response('Not authorized', 401);

    }

}
