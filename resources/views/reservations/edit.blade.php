@extends('layouts.app')

@section('content')
<div class="container">
    <h1>予約編集</h1>

    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">宿泊施設</label>
            <input type="text" class="form-control" value="{{ $reservation->post->title }}" disabled>
        </div>

        <div class="mb-3">
            <label for="num_guests" class="form-label">人数</label>
            <input type="number" name="num_guests" id="num_guests" class="form-control" value="{{ old('num_guests', $reservation->num_guests) }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">宿泊開始日</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $reservation->start_date) }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">宿泊終了日</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $reservation->end_date) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
