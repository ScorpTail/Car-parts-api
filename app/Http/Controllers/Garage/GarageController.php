<?php

namespace App\Http\Controllers\Garage;

use App\Models\Garage;
use App\Models\CarModel;
use App\Http\Controllers\Controller;
use App\Http\Resources\Garage\GarageResource;
use App\Services\GarageServices\GarageService;

class GarageController extends Controller
{
    public function __construct(public GarageService $garageService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GarageResource::collection(auth()->user()->garages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarModel $carModel)
    {
        $this->garageService->toggleCarModel($carModel);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Garage::query()->delete();

        return response()->noContent();
    }
}
