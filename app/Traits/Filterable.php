<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Filterable
{
    public function scopeFilter($query, Request $request)
    {
        if ($request->filled('country')) {
            $query->where('country_production', $request->country);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }


        return $query->get();
    }
}
