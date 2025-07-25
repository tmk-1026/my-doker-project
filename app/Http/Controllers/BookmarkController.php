<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    // ブックマーク追加
    public function store(Post $post)
    {
        if (auth()->user()->role !== 0) { // 一般ユーザーのみ
            abort(403, '一般ユーザーのみ操作可能です');
        }

        $user = auth()->user();

        if (!$user->bookmarks()->where('post_id', $post->id)->exists()) {
            $user->bookmarks()->attach($post->id);
        }

        return back()->with('status', 'ブックマークしました');
    }

    // ブックマーク解除
    public function destroy(Post $post)
    {
        if (auth()->user()->role !== 0) { // 一般ユーザーのみ
            abort(403, '一般ユーザーのみ操作可能です');
        }

        $user = auth()->user();

        if ($user->bookmarks()->where('post_id', $post->id)->exists()) {
            $user->bookmarks()->detach($post->id);
        }

        return response()->json(['message' => 'ブックマークを解除しました']);
    }

    // ブックマーク一覧表示
    public function index()
    {
        if (auth()->user()->role !== 0) { // 一般ユーザー以外は403
            abort(403, '一般ユーザーのみアクセス可能です');
        }

        $bookmarks = auth()->user()->bookmarks()->with('user')->get();
        return view('bookmarks.index', compact('bookmarks'));
    }
}

