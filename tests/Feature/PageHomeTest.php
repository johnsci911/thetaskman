<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses (RefreshDatabase::class);

it ('shows courses overview', function () {
    Course::factory()->create([
        'title' => 'Course A',
        'description' => 'Description Course A'
    ]);

    Course::factory()->create([
        'title' => 'Course B',
        'description' => 'Description Course B'
    ]);

    Course::factory()->create([
        'title' => 'Course C',
        'description' => 'Course C'
    ]);

    $this->get(route('home'))
        ->assertSeeText([
            'Course A',
            'Description Course A',
            'Course B',
            'Description Course B',
        ]);
});

it ('shows only released courses', function () {

});

it ('shows courses by release date', function () {

});
