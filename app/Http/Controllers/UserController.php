<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function posts()
    {
        $users = User::with('posts')->get();
        return view('users.index', compact('users'));
    }
    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('mypage.show')->with('success', 'プロフィールを更新しました');
    }
    
    public function profile(User $user)
    {
        $user->load('posts');
        return view('users.profile', compact('user'));
    }

    public function destroy()
    {
        $user = Auth::user();

        if ($user->role !== 0) {abort(403);}

        $user->delete();

        Auth::logout();

        return redirect('/')->with('success', '退会が完了しました。');
    }
}
