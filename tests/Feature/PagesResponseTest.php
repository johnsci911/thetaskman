<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('gives back successful response for home page', function () {
    $this->get(route('home'))
        ->assertOk();
});
