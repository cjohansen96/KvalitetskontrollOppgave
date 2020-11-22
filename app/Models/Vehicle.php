<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function vehicleModel() 
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function brand() 
    {
        return $this->belongsTo(Brand::class);
    }
}
