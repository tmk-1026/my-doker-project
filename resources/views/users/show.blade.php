@extends('layouts.app')

@section('content')
<div class="container">
    <h1>マイページ</h1>
    <p><strong>名前:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('mypage.edit') }}" class="btn btn-primary">プロフィール編集</a>
</div>
@endsection
