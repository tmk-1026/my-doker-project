<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function toggleVisibility(Post $post)
    {
        $post->is_visible = !$post->is_visible;
        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', '投稿ID ' . $post->id . ' の公開状態を変更しました。');
    }   
}
