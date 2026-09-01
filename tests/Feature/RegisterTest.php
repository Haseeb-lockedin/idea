<?php

use App\Models\User;

it('registers a user', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@example.com')
        ->fill('password', 'password123@#')
        ->click('@register-button')
        ->assertPathIs('/');
});

it('persists a user in the database after registration', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@example.com')
        ->fill('password', 'password123@#')
        ->click('@register-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();
    $this->assertDatabaseHas(User::class, [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});

it('shows validation errors when registering with invalid data', function () {
    visit('/register')
        ->click('@register-button')
        ->assertSee('the name field is required.')
        ->assertSee('The email field is required.')
        ->assertSee('The password field is required.');
});
