<?php

namespace App\Http\Controllers\ResourceController;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Owner::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'identification_number' => 'required|string|max:10',
            'first_name' => 'required|string|max:50',
            'second_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:50',
            'phone_number' => 'required|max:10',
        ]);

        $owner = new Owner();
        $owner->identification_number = $request->identification_number;
        $owner->first_name = $request->first_name;
        $owner->second_name = $request->second_name;
        $owner->last_name = $request->last_name;
        $owner->address = $request->address;
        $owner->phone_number = $request->phone_number;
        $owner->city_id = 1;
        $owner->status = 1;
        $owner->save();

        return $owner;
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
        $this->validate($request, [
            'identification_number' => 'required|max:10',
            'first_name' => 'required|string|max:50',
            'second_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:50',
            'phone_number' => 'required|max:10',
            'city_id'=>'required'
        ]);

        $owner = Owner::find($id);
        $owner->identification_number = $request->identification_number;
        $owner->first_name = $request->first_name;
        $owner->second_name = $request->second_name;
        $owner->last_name = $request->last_name;
        $owner->address = $request->address;
        $owner->phone_number = $request->phone_number;
        $owner->city_id = $request->city_id;
        $owner->update();

        return $owner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $owner = Owner::findOrFail($id);

        // delete the user
        $owner->status = 0;
        $owner->save();
    }
}
