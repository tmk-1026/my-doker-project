@extends('layouts.app')

@section('content')
<div class="container">
    <h1>マイページ</h1>
    <p><strong>名前:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('mypage.edit') }}" class="btn btn-primary">プロフィール編集</a>
    <form action="{{ route('mypage.destroy') }}" method="POST" onsubmit="return confirm('本当に退会しますか？');" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">退会</button>
    </form>
</div>
@endsection
