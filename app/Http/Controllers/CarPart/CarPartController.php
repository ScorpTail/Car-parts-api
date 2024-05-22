<?php

namespace App\Http\Controllers\CarPart;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarPart\CarPartResource;
use App\Models\Part;
use Illuminate\Http\Request;

class CarPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data = Part::filter($request);

        return CarPartResource::collection($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Part $carPart)
    {
        return CarPartResource::make($carPart);
    }
}
