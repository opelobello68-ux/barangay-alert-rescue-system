<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title ?? 'BARS' }} | Barangay Alert and Rescue System</title>
<link rel="stylesheet" href="{{ asset('css/bars.css') }}">
</head>
<body>
<div class="app-shell">
    @auth
    <aside class="sidebar">
        <div class="brand"><div class="logo">✚</div><div><b>BARS</b><small>Barangay Alert & Rescue</small></div></div>
        @if(auth()->user()->role === 'resident')
            <a href="{{ route('resident.dashboard') }}">🏠 Dashboard</a>
            <a href="{{ route('alerts.create') }}" class="alert-link">🚨 Send Alert</a>
            <a href="{{ route('alerts.index') }}">📋 My Alerts</a>
        @elseif(auth()->user()->role === 'responder')
            <a href="{{ route('responder.dashboard') }}">🏠 Dashboard</a>
        @else
            <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
            <a href="{{ route('admin.alerts') }}">🚨 Alerts & Incidents</a>
            <a href="{{ route('admin.users') }}">👥 Users</a>
        @endif
        <div class="sidebar-spacer"></div>
        <div class="user-mini">👤 {{ auth()->user()->name }}<small>{{ ucfirst(auth()->user()->role) }}</small></div>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="logout">↪ Logout</button></form>
    </aside>
    @endauth
    <main class="main">
        @if(session('success')) <div class="flash success">{{ session('success') }}</div> @endif
        @if($errors->any()) <div class="flash error"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div> @endif
        @yield('content')
    </main>
</div>
</body>
</html>
