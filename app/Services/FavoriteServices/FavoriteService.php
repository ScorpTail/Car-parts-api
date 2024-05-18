<?php

namespace App\Services\FavoriteServices;

use App\Models\Part;
use App\Services\BaseServices\BaseToggleServices\BaseToggleService;

class FavoriteService extends BaseToggleService
{
    public function __construct()
    {
        $this->relationMethod = 'favorites';
    }

    public function toggleCarPart(Part $carPart)
    {
        return $this->toggle($carPart);
    }
}
