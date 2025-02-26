<?php

use App\Models\Race;

test('it should be able to store a new race', function () {
    $model = new Race;
    $payload = Race::factory()->make()->toArray();

    $response = $this->postJson(route('api.races.store'), $payload);

    $response
        ->assertCreated()
        ->assertJsonStructure($model->getFillable());

    $this->assertDatabaseHas($model->getTable(), [
        'id' => $response->json('id'),
        ...$payload,
    ]);

    $this->assertDatabaseCount($model->getTable(), 1);
});
