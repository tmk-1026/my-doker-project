@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    <p><strong>住所:</strong> {{ $post->address }}</p>
    <p><strong>本文:</strong><br>{{ $post->body }}</p>
    <p><strong>料金:</strong> {{ $post->price }}円 / 泊</p>
    <p><strong>最大人数:</strong> {{ $post->max_guest }}人</p>
    <p><strong>予約受付期間:</strong> {{ $post->available_from }} ～ {{ $post->available_to }}</p>

    {{-- 戻るボタン --}}
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
</div>
@endsection
