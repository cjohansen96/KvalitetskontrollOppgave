<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\VehicleModel as VehicleModelResource;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get vehicle_models
        $vehicle_models = VehicleModel::all();

        // Return collection of vehicle_models as resource
        return VehicleModelResource::collection($vehicle_models);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicleModel = $request->isMethod('put') ? VehicleModel::findOrFail
        ($request->id) : new VehicleModel;

        $vehicleModel->id = $request->input('id');
        $vehicleModel->name = $request->input('name');
        $vehicleModel->seats = $request->input('seats');
        $vehicleModel->fuel_type = $request->input('fuel_type');

        if($vehicleModel->save()){
            return new VehicleModelResource($vehicleModel);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicleModel = VehicleModel::findOrFail($id);

        return new VehicleModelResource($vehicleModel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicleModel = VehicleModel::findOrFail($id);

        if($vehicleModel->delete()) {
            return new VehicleModelResource($vehicleModel);
        }
    }
}
