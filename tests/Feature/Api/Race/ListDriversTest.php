<?php

use App\Models\Driver;
use App\Models\Lap;
use App\Models\Race;
use App\Models\User;

test('it should be able to list all drivers', function () {
    $user = User::factory()->create();
    $race = Race::factory()->create([
        'total_laps' => 3,
    ]);

    $drivers = Driver::factory()->count(4)->create();

    $laps = [
        ['race_id' => $race->id, 'driver_id' => $drivers[0]->id, 'number' => 1, 'duration' => 10],
        ['race_id' => $race->id, 'driver_id' => $drivers[0]->id, 'number' => 2, 'duration' => 20],
        ['race_id' => $race->id, 'driver_id' => $drivers[0]->id, 'number' => 3, 'duration' => 30],

        ['race_id' => $race->id, 'driver_id' => $drivers[1]->id, 'number' => 1, 'duration' => 40],
        ['race_id' => $race->id, 'driver_id' => $drivers[1]->id, 'number' => 2, 'duration' => 50],
        ['race_id' => $race->id, 'driver_id' => $drivers[1]->id, 'number' => 3, 'duration' => 60],

        ['race_id' => $race->id, 'driver_id' => $drivers[3]->id, 'number' => 1, 'duration' => 70],
        ['race_id' => $race->id, 'driver_id' => $drivers[3]->id, 'number' => 2, 'duration' => 80],
        ['race_id' => $race->id, 'driver_id' => $drivers[3]->id, 'number' => 3, 'duration' => 90],

        ['race_id' => $race->id, 'driver_id' => $drivers[2]->id, 'number' => 1, 'duration' => 100],
        ['race_id' => $race->id, 'driver_id' => $drivers[2]->id, 'number' => 2, 'duration' => 110],
        ['race_id' => $race->id, 'driver_id' => $drivers[2]->id, 'number' => 3, 'duration' => 120],
    ];

    Lap::query()->insert($laps);

    $response = $this->actingAs($user)->getJson(route('api.races.drivers.index', [
        'race' => $race->id,
    ]));

    $race = $response->json();
    expect(count($race['positions']))->toBe(4);
    expect($race['positions'][0]['driver_id'])->toBe($drivers[0]->id);
    expect($race['positions'][1]['driver_id'])->toBe($drivers[1]->id);
    expect($race['positions'][2]['driver_id'])->toBe($drivers[3]->id);
    expect($race['positions'][3]['driver_id'])->toBe($drivers[2]->id);
});
