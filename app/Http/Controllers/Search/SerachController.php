<?php

namespace App\Http\Controllers\Search;

use App\Models\Part;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SerachController extends Controller
{

    public function __invoke(Request $request)
    {
        $query = $request->input('query');

        $results = Part::where('name', 'like', "%$query%")
            ->orWhere('article', 'like', "$query%")
            ->get();

        return response()->json($results);
    }
}
