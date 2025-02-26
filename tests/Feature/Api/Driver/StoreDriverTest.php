<?php

use App\Models\Driver;

test('it should be able to store a new driver', function () {
    $model = new Driver;
    $payload = Driver::factory()->make()->toArray();

    $response = $this->postJson(route('api.drivers.store'), $payload);

    $response
        ->assertCreated()
        ->assertJsonStructure($model->getFillable());

    $this->assertDatabaseHas($model->getTable(), [
        'id' => $response->json('id'),
        ...$payload,
    ]);

    $this->assertDatabaseCount($model->getTable(), 1);
});
