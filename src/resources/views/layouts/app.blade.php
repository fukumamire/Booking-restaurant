<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>Rese</title>
@yield('css')

</head>

<body>
  <header class="header-left">
    <input type="checkbox" id="overlay-input" class="overlay-toggle" />
    <label for="overlay-input" id="overlay-button" class="overlay-button"><span></span></label>
    <div id="overlay" class="overlay-menu">
    <ul class="nav__list">
      @if(Auth::guard('web')->check() || Auth::guard('admin')->check())
        <!-- ログインしている場合のメニュー -->
        <li><a href="{{ route('shops.index') }}" class="nav-link">Home</a></li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class= "logout-link">Logout</button>
          </form>
        </li>
        @if(Auth::guard('web')->check())
        <li><a href="{{ route('mypage') }}" class="nav-link">Mypage</a></li>
        @elseif(Auth::guard('admin')->check())
            <li><a href="{{ route('admin.index') }}" class="nav-link">Admin only page～管理者専用～</a></li>
          @endif
      @else
        <!-- ログインしていない場合のメニュー -->
        <li><a href="{{ route('shops.index') }}" class="nav-link">Home</a></li>
        <li><a href="{{ route('register') }}" class="nav-link">Registration</a></li>
        <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
        <li><a href="{{ route('admin.login') }}" class="nav-link">Admin Login</a></li>
      @endif
      </ul>
    </div>
    <div class="header__logo">Rese</div>
    @yield('header')
  </header>
  <main>
      @yield('content')
  </main>

    @yield('script')
</body>
</html>