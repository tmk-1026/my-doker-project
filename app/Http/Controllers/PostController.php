<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::latest()->get();
        return view('posts.index', compact('posts'));
    }
   
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'address' => 'required|max:255',
            'body' => 'required',
            'price' => 'required|numeric',
            'max_guest' => 'required|integer|min:1',
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
        ]);

        // 新規投稿を保存
        Post::create([
            'user_id' => auth()->id(), // ログインユーザーID
            'title' => $request->title,
            'address' => $request->address,
            'body' => $request->body,
            'price' => $request->price,
            'max_guest' => $request->max_guest,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to, 
        ]);

        // 投稿一覧ページへリダイレクト
        return redirect()->route('posts.index')->with('success', '投稿を作成しました');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'address' => 'required|max:255',
            'body' => 'required',
            'price' => 'required|numeric',
            'max_guest' => 'required|integer|min:1',
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
        ]);

        $post->update([
            'title' => $request->title,
            'address' => $request->address,
            'body' => $request->body,
            'price' => $request->price,
            'max_guest' => $request->max_guest,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', '投稿を更新しました');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', '投稿を削除しました');
    }


}
