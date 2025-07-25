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
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary">詳細を見る</a>
        </div>
    </div>
@endforeach
