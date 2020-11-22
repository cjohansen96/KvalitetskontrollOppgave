<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vehicle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'vehicle_model_id' => $this->vehicle_model_id,
            'license_plate' => $this->license_plate,
            'year_model' => $this->year_model,
            'mileage' => $this->mileage,
            'registration_date' => $this->registration_date,
            'veteran' => $this->veteran,
            'brand_name' => $this->brand->name,
            'vehicle_model_name' => $this->vehicleModel->name,
            
        ];
    }
}
