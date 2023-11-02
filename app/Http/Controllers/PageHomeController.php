<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;

class PageHomeController extends Controller
{
    public function __invoke()
    {
        $courses  = Course::query()
            ->released()
            ->orderBy('released_at', 'desc')
            ->get();

        return view('home', compact('courses'));
    }
}
