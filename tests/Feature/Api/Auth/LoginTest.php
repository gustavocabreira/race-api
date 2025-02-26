<?php

use App\Models\User;

test('it should be able to login', function () {
    $payload = [
        'email' => 'email@email.com',
        'password' => 'password',
    ];

    $user = User::factory()->create($payload);

    $response = $this->postJson(route('api.auth.login'), $payload);

    $response
        ->assertOk()
        ->assertJsonStructure(['access_token']);
});

test('it should return invalid credentials', function () {
    $payload = [
        'email' => 'email@email.com',
        'password' => 'wrong password',
    ];

    User::factory()->create([
        'email' => 'email@email.com',
        'password' => 'password',
    ]);

    $response = $this->postJson(route('api.auth.login'), $payload);

    $response->assertUnauthorized();
});
