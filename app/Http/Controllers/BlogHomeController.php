<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogHomeController extends Controller
{

    public function index()
    {
        // Ambil semua post yang published, urutkan dari yang terbaru
        $posts = Post::with(['category', 'author'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9); // Tampilkan 9 berita per halaman

        return view('guest.post-list', compact('posts'));
    }
    public function show($slug)
    {
        // Cari postingan yang statusnya published berdasarkan slug
        $post = Post::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Ambil berita lainnya untuk sidebar/rekomendasi
        $recent_posts = Post::where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        return view('guest.post-detail', compact('post', 'recent_posts'));
    }
}
