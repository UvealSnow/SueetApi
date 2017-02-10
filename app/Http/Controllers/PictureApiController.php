<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Picture;
use App\Pet;

class PictureApiController extends Controller {
    
    public function __construct () {
        $this->middleware('auth:api');
    }

    public function index() {
        return Picture::all();
    }

    public function store(Request $request) {
        $this->validate($request, [
            'image' => 'required|image',
        ]);
        $pic = Picture::find(1);
        $pic->path = $request->file('image')->store('test');
        $pet = Pet::find(1);
        $pet->unit_id = 1;
        $pet->save();
        $pet->picture()->save($pic);
        return '<img src="'.Storage::url($pic->path).'">';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
