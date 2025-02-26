<?php

namespace App\Http\Controllers;

use App\Http\Requests\Race\StoreRaceRequest;
use App\Models\Race;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RaceController extends Controller
{
    public function index(): JsonResponse
    {
        $races = Race::query()->orderBy('place')->get();

        return response()->json($races, Response::HTTP_OK);
    }

    public function store(StoreRaceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $race = Race::query()->create($validated);

        return response()->json($race, Response::HTTP_CREATED);
    }

    public function drivers(Race $race): JsonResponse
    {
        $drivers = $race->laps->groupBy('driver_id');

        $positions = $drivers->map(function ($laps) {
            return [
                'driver_id' => $laps->first()->driver->id,
                'name' => $laps->first()->driver->name,
                'duration' => $laps->sum('duration'),
                'best_lap' => $laps->sortBy('duration')->first(),
            ];
        })->sortBy('positions.duration')->values();

        $drivers = [
            ...$race->toArray(),
            'positions' => $positions,
        ];

        return response()->json($drivers, Response::HTTP_OK);
    }

    public function show(Race $race)
    {
        $drivers = $race->laps->groupBy('driver_id');
        $positions = $drivers->map(function ($laps) {
            return [
                'driver_id' => $laps->first()->driver->id,
                'name' => $laps->first()->driver->name,
                'duration' => $laps->sum('duration'),
            ];
        })->sortBy('positions.duration')->values();

        $response = [
            ...$race->toArray(),
            'duration' => $positions->last()['duration'],
            'drivers_count' => $positions->count(),
            'top_3' => $positions->take(3),
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
