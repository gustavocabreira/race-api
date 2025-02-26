<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Driver\StoreDriverRequest;
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

    public function store(StoreDriverRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $driver = Driver::query()->create($validated);

        return response()->json($driver, Response::HTTP_CREATED);
    }
}
