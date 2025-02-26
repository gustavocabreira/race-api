<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::query()->orderBy('name')->get();

        return response()->json($drivers, Response::HTTP_OK);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $driver = Driver::query()->create($validated);

        return response()->json($driver, Response::HTTP_CREATED);
    }
}
