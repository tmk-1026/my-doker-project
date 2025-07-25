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

    {{-- 予約ボタン --}}
    <a href="{{ route('reservations.create', $post->id) }}" class="btn btn-success mt-3">予約</a>

</div>

{{-- 通報ボタン（右下固定） --}}
@auth
     <button 
        onclick="document.getElementById('report-form').style.display='block'" 
        class="fixed bottom-5 right-5 flex items-center gap-2 bg-rose-600 text-white font-semibold px-4 py-2 rounded-full shadow-lg hover:bg-rose-700 transition"
        title="通報する"
    >
        🚨 通報
    </button>

    {{-- 通報フォーム（モーダル風） --}}
    <div id="report-form" 
         style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000;">
        <div style="background:white; padding:20px; border-radius:8px; width:400px; margin:100px auto;">
            <h3>違反報告</h3>
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <label for="reason">通報理由:</label>
                <textarea name="reason" id="reason" rows="4" style="width:100%;" required></textarea>

                <div style="margin-top:10px; text-align:right;">
                    <button type="submit" class="btn btn-danger">送信</button>
                    <button type="button" class="btn btn-secondary" 
                            onclick="document.getElementById('report-form').style.display='none'">
                        キャンセル
                    </button>
                </div>
            </form>
        </div>
    </div>
@endauth

{{-- フラッシュメッセージ --}}
@if(session('success'))
    <div style="position: fixed; bottom: 80px; right: 20px; background: green; color: white; padding: 10px; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif
@endsection
