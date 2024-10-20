@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<body class="register-page">
  <div class="registration-container">
    <div class="registration-header">
      <h2>Registration</h2>
    </div>
    <form action="/register" method="post" class="registration-form">
      @csrf
      <div class="form-group">
        <img src="auth-img/male.png" alt="userアイコン" width="30">
        <input type="text" id="username" name="name" placeholder="username" value="{{ old('name') }}">
        @error('name')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <img src="auth-img/mail.png" alt=",mailアイコン"  width="30">
        <input type="email" id="email" name="email" placeholder="email" value="{{ old('email') }}">
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <img src="auth-img/key.png" alt="keyアイコン" width="30">
        <input type="password" id="password" name="password" placeholder="password">
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <img src="{{ asset('auth-img/key.png') }}" alt="keyアイコン" width="30">
        <input type="password" id="confirm_password" name="password_confirmation" placeholder="確認用パスワード">
        @error('password_confirmation')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-submit">
        <button type="submit" class="submit-button">登録</button>
      </div>
    </form>

    <div class="admin-register-wrapper">
    <p class="admin-register-link">管理者として登録する場合は<a href="{{ route('admin.register') }}">こちら</a></p>
  </div>
  </div>
</body>
@endsection
