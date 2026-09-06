<?php

use App\Models\Idea;
use App\Models\User;

it('belongs to a User', function () {
    $idea = Idea::factory()->create();
    expect($idea->user)->toBeInstanceOf(User::class);
});

it('can have steps', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)->toBeEmpty();

    $idea->steps()->create([
        'description' => 'step 1',
    ]);

    expect($idea->fresh()->steps)->toHaveCount(1);
});

it('creates a new idea', function () {
    $this->actingAs($user = User::factory()->create());

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'do something man')
        ->click('@button-status-completed')
        ->fill('description', 'im going to do something big when i grow up')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'do something man',
        'status' => 'completed',
        'description' => 'im going to do something big when i grow up',
    ]);
});
