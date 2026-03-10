<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('user-operator.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user-operator.post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:category,id',
            'content' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published,archived'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($request->title);
        $data['excerpt'] = Str::limit(strip_tags($request->content), 150);

        // Logika untuk mengisi published_at jika statusnya published
        if ($request->status == 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('post-images', 'public');
        }

        Post::create($data);
        return redirect()->route('posts.index')->with('success', 'Postingan berhasil disimpan!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('user-operator.post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:category,id',
            'content' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published,archived'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['excerpt'] = Str::limit(strip_tags($request->content), 150);

        // Update published_at jika status berubah menjadi published
        if ($request->status == 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::delete('public/' . $post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('post-images', 'public');
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('success', 'Postingan berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::delete('public/' . $post->featured_image);
        }
        $post->delete();
        return back()->with('success', 'Postingan berhasil dihapus!');
    }
}
