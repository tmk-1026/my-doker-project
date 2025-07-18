<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * ユーザー一覧表示
     */
    public function index()
    {
        $users = User::paginate(10); // ページネーション
        return view('admin.users.index', compact('users'));
    }

    /**
     * 利用停止/再開切り替え
     */
    public function toggleStatus(User $user)
    {
        // 自分自身の状態は変更不可
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', '自分自身のステータスは変更できません。');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', $user->name . ' のステータスを変更しました。');
    }
}
