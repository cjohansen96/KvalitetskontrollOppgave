<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('lisence_plate');
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('vehicle_model_id')->constrained('vehicle_models');
            $table->year('year_model');
            $table->integer('mileage');
            $table->date('registration_date');
            $table->boolean('veteran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
