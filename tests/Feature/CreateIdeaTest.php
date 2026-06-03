<?php

it('has createideatest1 page', function () {
    $response = $this->get('/createideatest1');

    $response->assertStatus(200);
});
