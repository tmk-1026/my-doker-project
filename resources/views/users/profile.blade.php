@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}さんのプロフィール</h1>

    <p><strong>Email:</strong> {{ $user->email }}</p>

    @if($user->role == 1)
        <h2>宿泊施設一覧</h2>
        <ul>
            @forelse ($user->posts as $post)
                <li>{{ $post->title }}</li>
            @empty
                <li>宿泊施設は登録されていません</li>
            @endforelse
        </ul>
    @endif
</div>
@endsection
