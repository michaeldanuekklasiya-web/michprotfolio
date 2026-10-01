<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('index', [
            'projects' => Project::published()->get(),
            'posts' => Post::published()->take(3)->get(),
        ]);
    }
}
