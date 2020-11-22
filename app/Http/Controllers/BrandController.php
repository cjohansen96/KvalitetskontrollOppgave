<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Brand as BrandResource;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get brands
        $brand = Brand::all();

        // Return collection of brands as resource
        return BrandResource::collection($brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = $request->isMethod('put') ? Brand::findOrFail
        ($request->id) : new Brand;

        $brand->id = $request->input('id');
        $brand->name = $request->input('name');

        if($brand->save()){
            return new BrandResource($brand);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);

        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if($brand->delete()) {
            return new BrandResource($brand);
        }
    }
}
