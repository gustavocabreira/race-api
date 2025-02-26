<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Lap;
use App\Models\Race;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LapController extends Controller
{
    public function store(Race $race, Driver $driver, Request $request): JsonResponse
    {
        $validated = $request->validate([
            '*' => ['required', 'array', 'min:1'],
            '*.number' => ['required', 'integer', 'min:1'],
            '*.duration' => ['required', 'integer', 'min:1'],
        ]);

        $lapCount = count($validated);
        $lapsThatExists = $race->laps->where('driver_id', $driver->id)->count();

        if (($lapCount + $lapsThatExists) > $race->total_laps) {
            return response()->json([
                'message' => 'Can not create more laps than the race supports.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $payload = [];

        foreach ($validated as $lap) {
            $payload[] = [
                'race_id' => $race->id,
                'driver_id' => $driver->id,
                'number' => $lap['number'],
                'duration' => $lap['duration'],
            ];
        }

        $lap = Lap::query()->insert($payload);

        return response()->json($driver->laps, Response::HTTP_CREATED);
    }
}
