<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Postモデル

class HotelController extends Controller
{
    public function index(Request $request)
    {
        // 旅館ユーザーの投稿のみ取得（role=1のユーザーが作成した投稿）
        $posts = Post::with('user') // 投稿者情報も取得
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        
        //ログイン
         $user = auth()->user();
        if ($user->role === 0){
            return view('top', ['posts' => $posts]);
        }elseif ($user->role === 2) {
            return redirect()->route('admin.dashboard');
        } else {
        abort(403, 'アクセス権限がありません');
        }

        // Ajaxリクエストなら部分ビューだけ返す
        if ($request->ajax()) {
            return view('partials.post-list', compact('posts'))->render();
        }

        // 通常リクエストならトップページビューを返す
        return view('top', compact('posts'));
    }
}
