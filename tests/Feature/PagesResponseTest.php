<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('gives back successful response for home page', function () {
    $this->get(route('home'))
        ->assertOk();
});

it('gives back successful response for course details page', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    $this->get(route('course-details', $course))
        ->assertOk();
});
