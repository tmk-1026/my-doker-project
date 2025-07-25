@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新規投稿</h1>

    {{-- バリデーションエラーの表示 --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 新規投稿フォーム --}}
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf {{-- CSRF対策用のトークン --}}

        <div class="mb-3">
            <label for="title" class="form-label">旅館名</label>
            <input type="text" name="title" id="title" 
                   value="{{ old('title') }}" 
                   class="form-control" placeholder="旅館名を入力">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">住所</label>
            <input type="text" name="address" id="address"
                   value="{{ old('address') }}"
                   class="form-control" placeholder="住所を入力">
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">本文</label>
            <textarea name="body" id="body" rows="5" 
                      class="form-control" placeholder="本文を入力">{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">料金(1泊あたり)</label>
            <input type="number" name="price" id="price"
                   value="{{ old('price') }}"
                   class="form-control"  min="0" placeholder="料金を入力">
        </div>

        <div class="mb-3">
            <label for="max_guest" class="form-label">最大人数</label>
            <input type="number" name="max_guest" id="max_guest"
                   value="{{ old('max_guest') }}"
                   class="form-control" placeholder="最大人数を入力">
        </div>

        <div class="mb-3">
            <label for="available_from" class="form-label">予約受付開始日</label>
            <input type="date" name="available_from" id="available_from"
                   value="{{ old('available_from') }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label for="available_to" class="form-label">予約受付終了日</label>
            <input type="date" name="available_to" id="available_to"
                   value="{{ old('available_to') }}"
                   class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">投稿する</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
