<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Estate;
use App\Section;

class EstateApiController extends Controller {
    
    public function __construct () {
        $this->middleware('auth:api');
    }

    public function index () {
        $user = Auth::user();
        if ($user->can('view_all', Estate::class)) {
            if ($user->organisation)  return ['estates' => $user->organisation->estates];
            elseif ($user->employee)  return ['estates' => $user->employee->organisation->estates];
        }
        return response('Not Authorized', 401);
    }

    public function store (Request $request) {
            
        $user = Auth::user();

        if ($user->can('create', Estate::class)) {

            $this->validate($request, [
                'name' => 'required|string|max:255',
                'type' => 'required|string|in:residential,comercial',
                'lat' => 'required',
                'lng' => 'required',
                'ext_number' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'img' => 'image|max:6144',
                'sections' => 'required|array|min:1', // must be present and be an array
                'sections.*.name' => 'string|max:255', // thesed should be created during another call
            ]);

            $input = $request->all();
            $input['organisation_id'] = $user->employee->organisation_id;
            $input['manager_id'] = $user->id;
            $input['img'] = $request->file('img')->store('public/estates');

            $sections = collect($request->sections);
            unset($input['sections']);

            $estate = Estate::create($input);

            if ($sections->count() > 0) {
                foreach ($sections as $secton) {
                    $section['estate_id'] = $estate->id;
                    $section['manager_id'] = $user->id;
                    $section['state'] = 'operational';
                    $section['img'] = "public/estates/placeholder.png";
                    $area = Section::create($section);
                }
            }

            return $estate;

        }
        return response('Not Authorized', 401);

    }

    public function show ($id) {
        
        $user = Auth::user();
        $estate = Estate::find($id);

        if ($user->can('view', $estate)) {
            return $estate;
        }
        return response('Not Authorized', 401);

    }

    public function update (Request $request, $id) {
        
        $user = Auth::user();
        $estate = Estate::find($id);

        if ($user->can('update', $estate)) {

            $this->validate($request, [
                'name' => 'required|string|max:255',
                'type' => 'required|string|in:residential,comercial',
                'lat' => 'required',
                'lng' => 'required',
                'ext_number' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'img' => 'image|max:6144',
            ]);

            $estate->name = $request->name;
            $estate->type = $request->type;
            $estate->lat = $request->lat;
            $estate->lng = $request->lng;
            $estate->ext_number = $request->ext_number;
            $estate->street = $request->street;
            $estate->street = $request->street;
            $estate->district = $request->district;
            $estate->city = $request->city;
            $estate->state = $request->state;
            $estate->country = $request->street;
            if ($request->img != null) {
                Storage::delete($estate->img);
                $estate->img = $request->file('img')->store("public/estates/$estate->id/");
            }
            
            return $estate;
            
        }
        return response('Nope, not today', 403);

    }

    public function destroy ($id) {
        
        $user = Auth::user();
        $estate = Estate::find($id);
        if ($user->can('delete', $estate)) {
            $estate->delete();
            return response('Deleted', 200);
        }
        return response('Not Authorized', 401);

    }
}
