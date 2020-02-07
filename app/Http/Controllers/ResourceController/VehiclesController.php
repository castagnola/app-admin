<?php

namespace App\Http\Controllers\ResourceController;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicle::all();
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
            'color' => 'required',
            'placa' => 'required',
            'tipe_id' => 'required',
            'owner_id' => 'required',
            'driver_id' => 'required',
            'brand' => 'required',
        ]);

       $vehicle = new Vehicle();
       $vehicle->color = $request->color;
       $vehicle->placa = $request->placa;
       $vehicle->tipe_id = $request->tipe_id;
       $vehicle->brand = $request->brand;
       $vehicle->owner_id = $request->owner_id;
       $vehicle->driver_id = $request->driver_id;
       $vehicle->save();

       return $vehicle;

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
            'color' => 'required',
            'placa' => 'required',
            'tipe_id' => 'required',
            'owner_id' => 'required',
            'driver_id' => 'required',
            'brand' => 'required',
        ]);

        $vehicle = Vehicle::find($id);
        $vehicle->color = $request->color;
        $vehicle->placa = $request->placa;
        $vehicle->tipe_id = $request->tipe_id;
        $vehicle->brand = $request->brand;
        $vehicle->owner_id = $request->owner_id;
        $vehicle->driver_id = $request->driver_id;
        $vehicle->update();

        return $vehicle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Vehicle::findOrFail($id);

        // delete the user
        $user->status = 0;
        $user->save();
    }
}
