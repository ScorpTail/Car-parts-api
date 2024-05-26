<?php

namespace App\Services\ImageServices;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ImageService
{
    public function isImageExists($model): bool
    {
        $imagePath = $this->getImagePath($model);

        $relativePath = $this->relativePath($imagePath);

        $fileExists = Storage::disk('public')->exists($relativePath);

        return $fileExists;
    }

    public function getImage($fileName): array
    {
        if (!$this->isImageExists($fileName)) {
            throw ValidationException::withMessages(['error' => "Image not found, {$fileName}"]);
        }

        $file = Storage::disk('public')->get($fileName);

        $type = Storage::mimeType($fileName);

        return [$file, $type];
    }

    private function getImagePath($image): string
    {
        return is_string($image) ? $image : $image->image_path;
    }

    public function relativePath($path): string
    {
        return str_replace(env('APP_URL') . '/storage/', '', $path);
    }
}
