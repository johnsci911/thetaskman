<?php

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses (RefreshDatabase::class);

it ('shows courses overview', function () {
    // Arrange
    Course::factory()->create([
        'title' => 'Course A',
        'description' => 'Description Course A',
        'released_at' => Carbon::now(),
    ]);

    Course::factory()->create([
        'title' => 'Course B',
        'description' => 'Description Course B',
        'released_at' => Carbon::now(),
    ]);

    // Act & Assert
    $this->get(route('home'))
        ->assertSeeText([
            'Course A',
            'Description Course A',
            'Course B',
            'Description Course B',
        ]);
});

it ('shows only released courses', function () {
    // Arrange
    Course::factory()->create([
        'title' => 'Course A',
        'released_at' => Carbon::yesterday()
    ]);

    Course::factory()->create([
        'title' => 'Course B',
    ]);

    // Act & Assert
    $this->get(route('home'))
        ->assertSeeText([
            'Course A'
        ])
        ->assertDontSee([
            'Course B'
        ]);

});

it ('shows courses by release date', function () {
    // Arrange
    Course::factory()->create([
        'title' => 'Course A',
        'released_at' => Carbon::yesterday()
    ]);

    Course::factory()->create([
        'title' => 'Course B',
        'released_at' => Carbon::now()
    ]);

    // Act & Assert
    $this->get(route('home'))
    ->assertSeeTextInOrder([
        'Course B',
        'Course A',
    ]);
});
