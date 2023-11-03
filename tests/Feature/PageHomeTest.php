<?php

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\{get};

uses(RefreshDatabase::class);

it('shows courses overview', function () {
    // Arrange
    $courseOne = Course::factory()->released()->create();
    $courseTwo = Course::factory()->released()->create();

    // Act & Assert
    get(route('home'))
        ->assertSeeText([
            $courseOne->title,
            $courseOne->description,
            $courseTwo->title,
            $courseTwo->description,
        ]);
});

it('shows only released courses', function () {
    // Arrange
    $courseA = Course::factory()->released()->create();
    $courseB = Course::factory()->create();

    // Act & Assert
    get(route('home'))
        ->assertSeeText($courseA->title)
        ->assertDontSee($courseB->title);

});

it('shows courses by release date', function () {
    // Arrange
    $courseA = Course::factory()->released(Carbon::yesterday())->create();
    $courseB = Course::factory()->released(Carbon::now())->create();

    // Act & Assert
    get(route('home'))
        ->assertSeeTextInOrder([
            $courseB->title,
            $courseA->title,
        ]);
});
