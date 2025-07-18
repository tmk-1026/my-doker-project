@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">投稿一覧</h1>

    @if(session('success'))
        <div class="p-2 mb-4 bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">タイトル</th>
                <th class="px-4 py-2 border">投稿者</th>
                <th class="px-4 py-2 border">ステータス</th>
                <th class="px-4 py-2 border">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td class="px-4 py-2 border">{{ $post->id }}</td>
                <td class="px-4 py-2 border">{{ $post->title }}</td>
                <td class="px-4 py-2 border">{{ $post->user->name }}</td>
                <td class="px-4 py-2 border">
                    {{ $post->is_visible ? '公開中' : '非公開' }}
                </td>
                <td class="px-4 py-2 border">
                    <form action="{{ route('admin.posts.toggle', $post->id) }}" method="POST" onsubmit="return confirm('この投稿の表示状態を変更しますか？');">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded text-white {{ $post->is_visible ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                            {{ $post->is_visible ? '非公開にする' : '公開にする' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection