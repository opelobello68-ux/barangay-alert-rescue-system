@extends('layouts.app')
@section('content')
<div class="auth-page"><div class="auth-card">
<div class="auth-brand"><div class="logo">✚</div><h1>BARS</h1><p>Barangay Alert and Rescue System</p></div>
<h2>Welcome Back</h2><p class="muted">Sign in to continue.</p>
<form method="POST" action="{{ route('login.store') }}">@csrf
<label>Email Address</label><input type="email" name="email" value="{{ old('email') }}" required>
<label>Password</label><input type="password" name="password" required>
<label class="check"><input type="checkbox" name="remember"> Remember me</label>
<button class="btn blue full">Login</button></form>
<p class="center">No account? <a href="{{ route('register') }}">Register here</a></p>
<div class="demo"><b>Demo accounts</b><br>Resident: resident@bars.test / password<br>Responder: responder@bars.test / password<br>Admin: admin@bars.test / password</div>
</div></div>
@endsection
