<?php

namespace App\Http\Controllers\Favorite;

use App\Models\Part;
use App\Models\Favorite;
use App\Http\Controllers\Controller;
use App\Http\Resources\Favorite\FavoriteResource;
use App\Services\FavoriteServices\FavoriteService;

class FavoriteController extends Controller
{
    public function __construct(public FavoriteService $favoriteService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FavoriteResource::collection(auth()->user()->favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Part $carPart)
    {
        $this->favoriteService->toggleCarPart($carPart);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Favorite::query()->delete();

        return response()->noContent();
    }
}
