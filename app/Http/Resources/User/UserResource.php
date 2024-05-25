<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Favorite\FavoriteResource;
use App\Http\Resources\Garage\GarageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'favorites' => FavoriteResource::collection($this->favorites),
            'garages' => GarageResource::collection($this->garages),
        ];
    }
}
