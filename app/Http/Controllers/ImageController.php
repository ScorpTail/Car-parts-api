<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ImageServices\ImageService;

class ImageController extends Controller
{
    public function __construct(private ImageService $service)
    {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke($fileName)
    {
        [$file, $type] = $this->service->getImage($fileName);

        return response($file, Response::HTTP_OK)
            ->header('Content-Type', $type);
    }
}
