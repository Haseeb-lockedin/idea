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
