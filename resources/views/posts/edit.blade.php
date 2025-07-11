@extends('layouts.app')

@section('content')
<div class="container">
    <h1>投稿編集</h1>

    {{-- バリデーションエラー表示 --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 投稿編集フォーム --}}
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- タイトル --}}
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $post->title) }}"
                   class="form-control" placeholder="タイトルを入力">
        </div>

        {{-- 住所 --}}
        <div class="mb-3">
            <label for="address" class="form-label">住所</label>
            <input type="text" name="address" id="address"
                   value="{{ old('address', $post->address) }}"
                   class="form-control" placeholder="住所を入力">
        </div>

        {{-- 本文 --}}
        <div class="mb-3">
            <label for="body" class="form-label">本文</label>
            <textarea name="body" id="body" rows="5"
                      class="form-control" placeholder="本文を入力">{{ old('body', $post->body) }}</textarea>
        </div>

        {{-- 料金 --}}
        <div class="mb-3">
            <label for="price" class="form-label">料金</label>
            <input type="number" name="price" id="price"
                   value="{{ old('price', $post->price) }}"
                   class="form-control" placeholder="料金を入力">
        </div>

        {{-- 最大人数 --}}
        <div class="mb-3">
            <label for="max_guest" class="form-label">最大人数</label>
            <input type="number" name="max_guest" id="max_guest"
                   value="{{ old('max_guest', $post->max_guest) }}"
                   class="form-control" placeholder="最大人数を入力">
        </div>

        {{-- 予約受付開始日 --}}
        <div class="mb-3">
            <label for="available_from" class="form-label">予約受付開始日</label>
            <input type="date" name="available_from" id="available_from"
                   value="{{ old('available_from', $post->available_from) }}"
                   class="form-control">
        </div>

        {{-- 予約受付終了日 --}}
        <div class="mb-3">
            <label for="available_to" class="form-label">予約受付終了日</label>
            <input type="date" name="available_to" id="available_to"
                   value="{{ old('available_to', $post->available_to) }}"
                   class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
