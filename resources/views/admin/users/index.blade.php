@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">ユーザー一覧</h1>

    @if(session('success'))
        <div class="p-2 mb-4 bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-2 mb-4 bg-red-100 border border-red-400 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <table class="table-auto w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">名前</th>
                <th class="px-4 py-2 border">メール</th>
                <th class="px-4 py-2 border">ステータス</th>
                <th class="px-4 py-2 border">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="px-4 py-2 border">{{ $user->id }}</td>
                <td class="px-4 py-2 border">{{ $user->name }}</td>
                <td class="px-4 py-2 border">{{ $user->email }}</td>
                <td class="px-4 py-2 border">
                    {{ $user->is_active ? '有効' : '停止中' }}
                </td>
                <td class="px-4 py-2 border">
                    @if(auth()->id() !== $user->id)
                    <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" onsubmit="return confirm('ステータスを変更しますか？');">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded text-white {{ $user->is_active ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                            {{ $user->is_active ? '利用停止' : '再開' }}
                        </button>
                    </form>
                    @else
                        <span class="text-gray-400">操作不可</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
