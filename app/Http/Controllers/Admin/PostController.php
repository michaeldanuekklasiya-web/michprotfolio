<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Support\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->when($request->q, fn ($q, $term) => $q->where('title', 'like', "%{$term}%"))
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form', ['post' => new Post(['is_published' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Post::uniqueSlug($data['slug'] ?? $data['title']);

        if ($request->hasFile('cover')) {
            $data['cover_image'] = ImageUploader::store($request->file('cover'), 'posts');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('status', 'Artikel berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validated($request, $post);
        $data['slug'] = Post::uniqueSlug($data['slug'] ?? $data['title'], $post->id);

        if ($request->hasFile('cover')) {
            ImageUploader::delete($post->cover_image);
            $data['cover_image'] = ImageUploader::store($request->file('cover'), 'posts');
        } elseif ($request->boolean('remove_cover')) {
            ImageUploader::delete($post->cover_image);
            $data['cover_image'] = null;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('status', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        ImageUploader::delete($post->cover_image);
        $post->delete();

        return back()->with('status', 'Artikel dihapus.');
    }

    private function validated(Request $request, ?Post $post = null): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'slug' => ['nullable', 'string', 'max:200', 'alpha_dash', Rule::unique('posts', 'slug')->ignore($post?->id)],
            'category' => 'nullable|string|max:60',
            'excerpt' => 'nullable|string|max:400',
            'body' => 'required|string',
            'cover' => 'nullable|image|max:8192',
            'published_at' => 'nullable|date',
        ]);
        unset($data['cover']);

        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['published_at']
            ?? ($data['is_published'] ? ($post?->published_at ?? now()) : null);

        return $data;
    }
}
