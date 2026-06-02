<?php

declare(strict_types=1);

use App\Models\Idea;
use App\Models\User;

test('idea belongs to a user', function () {
    $idea = Idea::factory()->create();

    expect($idea->user)->toBeInstanceOf(User::class);
});

test('idea can have steps', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)->toBeEmpty();
});
