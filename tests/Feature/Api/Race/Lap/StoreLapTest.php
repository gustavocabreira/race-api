<?php

use App\Models\Driver;
use App\Models\Lap;
use App\Models\Race;

test('it should be able to store a new lap', function () {
    $model = new Lap;
    $race = Race::factory()->create([
        'total_laps' => 3,
    ]);

    $driver = Driver::factory()->create();

    $payload = [
        ['number' => 1, 'duration' => rand(60, 180)],
        ['number' => 2, 'duration' => rand(60, 180)],
        ['number' => 3, 'duration' => rand(60, 180)],
    ];

    $response = $this->postJson(route('api.races.drivers.laps.store', [
        'race' => $race->id,
        'driver' => $driver->id,
    ]), $payload);

    $response
        ->assertCreated()
        ->assertJsonStructure([
            '*' => $model->getFillable(),
        ]);

    foreach ($payload as $lap) {
        $this->assertDatabaseHas($model->getTable(), [
            'race_id' => $race->id,
            'driver_id' => $driver->id,
            'number' => $lap['number'],
            'duration' => $lap['duration'],
        ]);
    }

    $this->assertDatabaseCount($model->getTable(), 3);
});

test('it should return not found when trying to create a new lap to a race that does not exist', function () {
    $model = new Lap;

    $driver = Driver::factory()->create();

    $response = $this->postJson(route('api.races.drivers.laps.store', [
        'race' => -1,
        'driver' => $driver->id,
    ]));

    $response->assertNotFound();

    $this->assertDatabaseCount($model->getTable(), 0);
});

test('it should return not found when trying to create a new lap to a driver that does not exist', function () {
    $model = new Lap;

    $race = Race::factory()->create();

    $response = $this->postJson(route('api.races.drivers.laps.store', [
        'race' => $race->id,
        'driver' => -1,
    ]));

    $response->assertNotFound();

    $this->assertDatabaseCount($model->getTable(), 0);
});

test('it should not create a new lap when trying to insert more laps than the race have', function () {
    $model = new Lap;
    $race = Race::factory()->create();
    $driver = Driver::factory()->create();

    $race = Race::factory()->create([
        'total_laps' => 1,
    ]);

    Lap::query()->insert([
        'race_id' => $race->id,
        'driver_id' => $driver->id,
        'number' => 1,
        'duration' => rand(60, 180),
    ]);

    $driver = Driver::factory()->create();

    $payload = [
        ['number' => 2, 'duration' => rand(60, 180)],
        ['number' => 3, 'duration' => rand(60, 180)],
    ];

    $response = $this->postJson(route('api.races.drivers.laps.store', [
        'race' => $race->id,
        'driver' => $driver->id,
    ]), $payload);

    $response->assertUnprocessable();

    expect($response->json('message'))->toBe('Can not create more laps than the race supports.');
});
