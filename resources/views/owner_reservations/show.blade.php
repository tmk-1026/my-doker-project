@extends('layouts.app')

@section('content')
<div class="container">
    <h1>予約詳細</h1>

    <p><strong>宿泊者名:</strong> {{ $reservation->user->name }}</p>
    <p><strong>宿泊施設:</strong> {{ $reservation->post->title }}</p>
    <p><strong>宿泊期間:</strong> {{ $reservation->start_date }} ～ {{ $reservation->end_date }}</p>
    <p><strong>人数:</strong> {{ $reservation->num_guests }}名</p>
    <p><strong>作成日:</strong> {{ $reservation->created_at }}</p>
    <p><strong>現在のステータス:</strong> {{ ucfirst($reservation->status) }}</p>

    <form action="{{ route('owner.reservations.updateStatus', $reservation) }}" method="POST" class="mt-3">
        @csrf
        @method('PATCH')

        <label for="status">ステータス変更:</label>
        <select name="status" id="status" class="form-select mb-2">
            <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>保留中</option>
            <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>確認済み</option>
            <option value="canceled" {{ $reservation->status === 'canceled' ? 'selected' : '' }}>キャンセル</option>
        </select>

        <button type="submit" class="btn btn-primary">ステータス更新</button>
    </form>

    <a href="{{ route('owner.reservations.index') }}" class="btn btn-secondary">一覧に戻る</a>
</div>

@endsection
