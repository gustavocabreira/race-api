<?php

use App\Models\Driver;
use App\Models\Lap;
use App\Models\Race;

test('it should be able to store a new lap', function () {
    $model = new Lap;
    $race = Race::factory()->create();
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
