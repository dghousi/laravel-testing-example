<?php
use App\Models\User;

test('user can log in with valid credentials', function () {
    $password = 'password123';
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt($password),
    ]);

    $response = $this->post('/login', [
        'email' => 'user@example.com',
        'password' => $password,
    ]);

    $response->assertRedirect('/dashboard'); // or your intended redirect
    $this->assertAuthenticatedAs($user);
});


test('user can register with valid data', function () {
    $response = $this->post('/register', [
        'name' => 'New User',
        'email' => 'newuser@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/dashboard'); // or your intended redirect
    $this->assertDatabaseHas('users', [
        'email' => 'newuser@example.com',
        'name' => 'New User',
    ]);
});