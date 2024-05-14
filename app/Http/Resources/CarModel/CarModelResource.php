<?php

namespace App\Http\Resources\CarModel;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'car-model_id' => $this->id,
            'brand_id' => $this->brand_id,
            'name' => $this->name,

            
        ];
    }
}
