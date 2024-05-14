<?php

namespace App\Http\Resources\CarPart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarPartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'car-part_id' => $this->id,
            'model_id' => $this->model_id,
            'article' => $this->article,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,

            'created_at' => $this->created_at,
            'isDeleted' => $this->emptyDeletedAtRows(),
        ];
    }
}
