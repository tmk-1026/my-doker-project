@extends('layouts.app')

@section('content')
<div class="container">
    <h1>投稿一覧</h1>

    {{-- 成功メッセージの表示 --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 新規投稿ボタン --}}
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">新規投稿</a>

    {{-- 投稿があるかチェック --}}
    @if($posts->isEmpty())
        <p>投稿はまだありません。</p>
    @else
        {{-- 投稿一覧表示 --}}
        @foreach($posts as $post)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                    <p class="text-muted small">投稿者: {{ $post->user->name ?? '不明' }}</p>

                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">詳細</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">編集</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('削除しますか？')">削除</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

