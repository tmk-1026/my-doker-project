@extends('layouts.app')

@section('content')
<div class="container">
    <h1>予約一覧</h1>

    <a href="{{ route('reservations.create') }}" class="btn btn-success">新規予約</a>

    @if ($reservations->isEmpty())
        <p>現在予約はありません。</p>
    @else
        <ul>
        @foreach ($reservations as $reservation)
            <li>
                宿泊施設: {{ $reservation->post->title }} <br>
                宿泊期間: {{ $reservation->start_date }} ～ {{ $reservation->end_date }}<br>
                人数: {{ $reservation->num_guests }}名
                <br>
                <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-sm btn-warning">編集</a>
                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </li>
        @endforeach
        </ul>
    @endif
</div>
@endsection
