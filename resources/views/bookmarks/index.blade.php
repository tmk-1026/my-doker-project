@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">ブックマーク一覧</h2>

    @if ($bookmarks->isEmpty())
        <p class="text-center">ブックマークがありません。</p>
    @else
        @foreach ($bookmarks as $post)
            <div class="card mb-4">
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="投稿画像">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                    <p class="text-muted">投稿者: {{ $post->user->name }}</p>

                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary me-2">
                        投稿詳細
                    </a>
                    <button class="btn btn-danger btn-remove-bookmark" data-post-id="{{ $post->id }}">
                        ブックマーク解除
                    </button>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn-remove-bookmark');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const postId = this.dataset.postId;

                if (confirm('ブックマークを解除しますか？')) {
                    fetch(`/posts/${postId}/bookmark`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            // 投稿カードをDOMから削除
                            document.getElementById(`bookmark-${postId}`).remove();

                            // 残りのブックマークが0件ならメッセージを表示
                            if (document.querySelectorAll('.bookmark-card').length === 0) {
                                const container = document.querySelector('.container');
                                container.innerHTML = '<p class="text-center">ブックマークがありません。</p>';
                            }
                        } else {
                            alert('削除に失敗しました');
                        }
                    })
                    .catch(() => {
                        alert('通信エラーが発生しました');
                    });
                }
            });
        });
    });
</script>
@endpush
