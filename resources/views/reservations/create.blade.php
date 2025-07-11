@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新規予約</h1>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="post_id" class="form-label">宿泊施設</label>
            <select name="post_id" id="post_id" class="form-select" required>
                <option value="">選択してください</option>
                @foreach($posts as $post)
                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="num_guests" class="form-label">人数</label>
            <input type="number" name="num_guests" id="num_guests" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">宿泊開始日</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">宿泊終了日</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">予約</button>
    </form>
</div>
@endsection
