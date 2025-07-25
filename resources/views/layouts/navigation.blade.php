<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
    <div class="container">
        <!-- Logo -->
        @if (auth()->check())
            <a class="navbar-brand"
               href="
                    @if(auth()->user()->role === 2)
                        {{ route('admin.dashboard') }}
                    @elseif(auth()->user()->role === 1)
                        {{ route('owner.dashboard') }}
                    @else
                        {{ route('mypage.show') }}
                    @endif
               ">
                <img src="{{ asset('logo.png') }}" alt="Logo" height="40">
            </a>
        @else
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="Logo" height="40">
            </a>
        @endif

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left Side -->
            <ul class="navbar-nav me-auto">
                <!-- トップページリンク（常に表示） -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        {{ __('トップページ') }}
                    </a>
                </li>

                <!-- ログイン済みユーザー向けダッシュボードリンク -->
                @if (auth()->check())
                    <li class="nav-item">
                        <a class="nav-link
                            @if(auth()->user()->role === 2 && request()->routeIs('admin.*')) active
                            @elseif(auth()->user()->role === 1 && request()->routeIs('owner.*')) active
                            @elseif(auth()->user()->role === 0 && request()->routeIs('mypage.show')) active
                            @endif"
                            href="
                                @if(auth()->user()->role === 2)
                                    {{ route('admin.dashboard') }}
                                @elseif(auth()->user()->role === 1)
                                    {{ route('owner.dashboard') }}
                                @else
                                    {{ route('mypage.show') }}
                                @endif
                            ">
                            {{ __('Dashboard') }}
                        </a>
                    </li>
                @endif
            </ul>

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto">
                @if (auth()->check())
                    <!-- ログイン済みユーザーのドロップダウン -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </li>
                @else
                    <!-- 未ログイン時のメニュー -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
