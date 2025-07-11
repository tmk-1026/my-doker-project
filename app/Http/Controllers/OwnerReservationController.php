<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class OwnerReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::whereHas('post', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['user', 'post'])->get();

        return view('owner_reservations.index', compact('reservations'));
    }

    public function show(\App\Models\Reservation $reservation)
    {
        // 自分の宿泊施設の予約だけ確認可能
        if ($reservation->post->user_id !== Auth::id()) {abort(403);}
        return view('owner_reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        if ($reservation->post->user_id !== Auth::id()) {abort(403);}

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,canceled'
        ]);

        $reservation->status = $validated['status'];
        $reservation->save();

        return redirect()->route('owner.reservations.show', $reservation)->with('success', '予約ステータスを更新しました');
    }

}
