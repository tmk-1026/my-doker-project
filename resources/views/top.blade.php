@extends('layouts.app')

@section('content')
    <!-- 検索フォーム -->
    <div class="mb-4">
        <form action="{{ route('search') }}" method="GET" class="d-flex">
            <input type="text" name="keyword" class="form-control me-2" placeholder="キーワード・旅館名・日付">
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>

    <!-- 投稿一覧 -->
    <div id="post-list">
        @foreach ($posts as $post)
            <div class="card mb-4">
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="投稿画像">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                    <p class="text-muted mb-2">
                        投稿者: {{ $post->user->name }} |
                        投稿日: {{ $post->created_at->format('Y-m-d') }}
                    </p>
                    @auth
                        @if (auth()->user()->role === 0|auth()->user()->role === 1) 
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary me-2">
                                詳細を見る
                            </a>
                            <form action="{{ route('bookmarks.store', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary">ブックマーク</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <!-- 無限スクロールの読み込みインジケータ -->
    <div id="loading" class="text-center my-4" style="display: none;">
        <span class="spinner-border"></span> 読み込み中...
    </div>
@endsection

@push('scripts')
<script>
    let page = 1;
    window.onscroll = function() {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300) {
            loadMoreData();
        }
    };

    function loadMoreData() {
        if (document.getElementById('loading').style.display === 'block') return;
        page++;
        document.getElementById('loading').style.display = 'block';

        fetch(`?page=${page}`)
            .then(response => response.text())
            .then(data => {
                if (data.trim() === '') {
                    // データが無ければ無限スクロール停止
                    window.onscroll = null;
                } else {
                    document.getElementById('post-list').insertAdjacentHTML('beforeend', data);
                }
                document.getElementById('loading').style.display = 'none';
            })
            .catch(() => {
                document.getElementById('loading').style.display = 'none';
            });
    }
</script>
@endpush

