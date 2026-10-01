<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use App\Models\SiteLike;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'stats' => [
                'posts' => Post::count(),
                'published' => Post::where('is_published', true)->count(),
                'projects' => Project::count(),
                'unread' => Message::whereNull('read_at')->count(),
                'likes' => (int) SiteLike::value('count'),
            ],
            'recentPosts' => Post::latest('updated_at')->take(5)->get(),
            'recentMessages' => Message::latest()->take(5)->get(),
        ]);
    }
}
