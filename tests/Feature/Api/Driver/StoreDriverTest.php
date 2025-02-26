<?php

use App\Models\Driver;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

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

dataset('invalid_payload', [
    'empty name' => [
        ['name' => ''], ['name' => 'The name field is required.'],
    ],
    'name with more than 255 characters' => [
        ['name' => Str::repeat('*', 256)], ['name' => 'The name field must not be greater than 255 characters.'],
    ],
]);

test('it should return unprocessable entity when providing invalid payload', function (array $payload, array $expectedErrors) {
    $key = array_keys($expectedErrors);
    $model = new Driver;

    $response = $this->postJson(route('api.drivers.store'), $payload);

    $response
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors($key);

    $this->assertDatabaseMissing($model->getTable(), $payload);
    $this->assertDatabaseCount($model->getTable(), 0);
})->with('invalid_payload');
