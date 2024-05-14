<?php

namespace App\Http\Controllers\CarModel;

use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarModel\CarModelResource;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarModelResource::collection(CarModel::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $carModel)
    {
        return CarModelResource::make($carModel);
    }
}
