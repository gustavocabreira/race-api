<?php

namespace App\Http\Controllers;

use App\Http\Requests\Race\StoreRaceRequest;
use App\Models\Race;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RaceController extends Controller
{
    public function store(StoreRaceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $race = Race::query()->create($validated);

        return response()->json($race, Response::HTTP_CREATED);
    }
}
