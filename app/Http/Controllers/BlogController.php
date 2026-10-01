<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()
            ->when($request->category, fn ($q, $cat) => $q->where('category', $cat))
            ->paginate(9)
            ->withQueryString();

        $categories = Post::published()->reorder()->whereNotNull('category')
            ->distinct()->orderBy('category')->pluck('category');

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        $related = Post::published()
            ->whereKeyNot($post->id)
            ->when($post->category, fn ($q, $cat) => $q->orderByRaw('category = ? desc', [$cat]))
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
