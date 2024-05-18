<?php

namespace App\Http\Resources\Brand;

use App\Http\Resources\CarModel\CarModelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'brand_id' => $this->id,
            'name' => $this->name,
            'image_path' => $this->image_path,

            'brand_models' => CarModelResource::collection($this->models),
        ];
    }
}
