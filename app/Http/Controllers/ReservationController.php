<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Post;


class ReservationController extends Controller
{
     public function index()
    {
        $reservations = Auth::user()->reservations()->with('post')->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $posts = \App\Models\Post::all();
        return view('reservations.create', compact('posts'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'num_guests' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $validated['user_id'] = Auth::id();

        Reservation::create($validated);

        return redirect()->route('reservations.index')->with('success', '予約が登録されました');
    }

    public function edit(Reservation $reservation)
    {
        // 自分の予約のみ編集
        if ($reservation->user_id !== Auth::id()) {abort(403);}
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        // 自分の予約のみ更新
        if ($reservation->user_id !== Auth::id()) {abort(403);}

        $validated = $request->validate([
            'num_guests' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $reservation->update($validated);
        return redirect()->route('reservations.index')->with('success', '予約を更新しました');
    }

    public function destroy(Reservation $reservation)
    {
        // 自分の予約のみ削除
        if ($reservation->user_id !== Auth::id()) {abort(403);}
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', '予約を削除しました');
    }

}

