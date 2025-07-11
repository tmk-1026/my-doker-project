@extends('layouts.app')

@section('content')
<div class="container">
    <h1>宿泊施設予約一覧</h1>

    @if ($reservations->isEmpty())
        <p>現在予約はありません。</p>
    @else
        <ul>
        @foreach ($reservations as $reservation)
            <li>
                <strong>宿泊者:</strong> {{ $reservation->user->name }}<br>
                <strong>宿泊施設:</strong> {{ $reservation->post->title }}<br>
                <strong>宿泊期間:</strong> {{ $reservation->start_date }} ～ {{ $reservation->end_date }}<br>
                <strong>人数:</strong> {{ $reservation->num_guests }}名
            </li>
        @endforeach
        <a href="{{ route('owner.reservations.show', $reservation) }}" class="btn btn-sm btn-info">詳細</a>

        </ul>
    @endif
</div>
@endsection
