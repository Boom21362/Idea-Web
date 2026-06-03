<?php

use App\Models\User;

it('has createideatest1 page', function () {
    $this->actingAs(User::factory()->create());

   visit('/ideas')
    ->click('@create-idea-button')
    ->debug();
});
