<?php

namespace App\Services\GarageServices;

use App\Models\CarModel;
use App\Services\BaseServices\BaseToggleServices\BaseToggleService;

class GarageService extends BaseToggleService
{
    public function __construct()
    {
        $this->relationMethod = 'garages';
    }

    public function toggleCarModel(CarModel $carModel)
    {
        return $this->toggle($carModel);
    }
}
