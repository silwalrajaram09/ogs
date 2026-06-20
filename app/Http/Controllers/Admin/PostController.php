<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::with('author:id,full_name')
            ->latest()
            ->paginate(15)
            ->through(fn($post) => [
                'id' => $post->id,
                'title' => $post->name,
                'slug' => $post->slug,
                'type' => $post->type,
                'author' => $post->author?->full_name ?? 'Unknown',
                'is_published' => $post->published_at && $post->published_at->lte(now()),
                'published_at' => $post->published_at?->format('M j, Y'),
                'default_photo' => $post->photo_url, // 👈 ADD PHOTO URL
            ]);

        return Inertia::render('admin/posts/index', ['posts' => $posts]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/posts/create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        // 👈 HANDLE PHOTO UPLOAD
        $photoPath = null;
        if ($request->hasFile('default_photo')) {
            $photoPath = $request->file('default_photo')->store('posts', 'public');
        }

        Post::create([
            'name' => $request->title,
            'slug' => $request->slug,
            'type' => $request->type,
            'description' => $request->body,
            'default_photo' => $photoPath, // 👈 SAVE PHOTO PATH
            'author_id' => $request->user()->id,
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post created.');
    }

    public function edit(Post $post): Response
    {
        return Inertia::render('admin/posts/edit', [
            'post' => [
                'id' => $post->id,
                'title' => $post->name,
                'slug' => $post->slug,
                'type' => $post->type,
                'body' => $post->description,
                'is_published' => $post->published_at && $post->published_at->lte(now()),
                'published_at' => $post->published_at?->format('M j, Y'),
                'default_photo' => $post->photo_url, // 👈 ADD PHOTO URL
                'default_photo_path' => $post->default_photo, // 👈 ADD RAW PATH FOR EDITING
            ],
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        // 👈 HANDLE PHOTO UPLOAD
        $photoPath = $post->default_photo;

        if ($request->hasFile('default_photo')) {
            // Delete old photo if exists
            if ($post->default_photo && Storage::disk('public')->exists($post->default_photo)) {
                Storage::disk('public')->delete($post->default_photo);
            }

            $photoPath = $request->file('default_photo')->store('posts', 'public');
        }

        $post->update([
            'name' => $request->title,
            'slug' => $request->slug,
            'type' => $request->type,
            'description' => $request->body,
            'default_photo' => $photoPath, // 👈 UPDATE PHOTO PATH
            'published_at' => $request->boolean('is_published')
                ? ($post->published_at ?? now())
                : null,
        ]);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post updated.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        // 👈 DELETE PHOTO WHEN POST IS DELETED
        if ($post->default_photo && Storage::disk('public')->exists($post->default_photo)) {
            Storage::disk('public')->delete($post->default_photo);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted.');
    }
}