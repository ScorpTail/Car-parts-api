<?php

namespace App\Services\ImageServices;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function isImageExists($model): bool
    {
        $relativePath = str_replace(env('APP_URL') . '/storage/', '', $model->image_path);
        $fileExists = Storage::disk('public')->exists($relativePath);

        return $fileExists;
    }
}
