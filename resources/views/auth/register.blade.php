@extends('layouts.app')
@section('content')
<div class="auth-page"><div class="auth-card wide">
<div class="auth-brand"><div class="logo">✚</div><h1>Create Account</h1><p>Join BARS to report emergencies.</p></div>
<form method="POST" action="{{ route('register.store') }}">@csrf
<div class="form-grid"><div><label>Full Name</label><input name="name" required></div><div><label>Email</label><input type="email" name="email" required></div><div><label>Contact Number</label><input name="contact_number" required></div><div><label>Address / Community</label><input name="address" required></div><div><label>Password</label><input type="password" name="password" required></div><div><label>Confirm Password</label><input type="password" name="password_confirmation" required></div></div>
<button class="btn blue full">Create Account</button></form>
<p class="center">Already registered? <a href="{{ route('login') }}">Login</a></p>
</div></div>
@endsection
