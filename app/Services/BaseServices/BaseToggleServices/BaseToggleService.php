<?php

namespace App\Services\BaseServices\BaseToggleServices;

use Illuminate\Support\Facades\Auth;

class BaseToggleService
{
    protected $relationMethod;

    public function toggle($model)
    {
        $user = Auth::user();

        if ($user->{$this->relationMethod}->contains('id', $model->id)) {
            $user->{$this->relationMethod}()->detach(['id' => $model->id]);
        } else {
            $user->{$this->relationMethod}()->attach(['id' => $model->id]);
        }

        return response()->noContent();
    }
}
