<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Vehicle as VehicleResource;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get vehicles
        $vehicles = Vehicle::all();

        // Return collection of vehicle as resource
        return VehicleResource::collection($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = $request->isMethod('put') ? Vehicle::findOrFail
        ($request->id) : new Vehicle;

        $vehicle->id = $request->input('id');
        $vehicle->brand_id = $request->input('brand_id');
        $vehicle->vehicle_model_id = $request->input('vehicle_model_id');
        $vehicle->license_plate = $request->input('license_plate');
        $vehicle->year_model = $request->input('year_model');
        $vehicle->mileage = $request->input('mileage');
        $vehicle->registration_date = $request->input('registration_date');
        $vehicle->veteran = $request->input('veteran');

        if($vehicle->save()){
            return new VehicleResource($vehicle);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return new VehicleResource($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        if($vehicle->delete()) {
            return new VehicleResource($vehicle);
        }
    }
}
