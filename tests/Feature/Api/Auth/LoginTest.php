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
