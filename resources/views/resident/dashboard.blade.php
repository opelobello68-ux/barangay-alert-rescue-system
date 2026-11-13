@extends('layouts.app')
@section('content')
<div class="page-head"><div><span class="eyebrow">RESIDENT PORTAL</span><h1>Good day, {{ auth()->user()->name }}!</h1><p>Stay alert. Stay safe. Request help when you need it.</p></div><div class="location">📍 {{ auth()->user()->address }}</div></div>
<div class="hero-alert"><div><span>🚨</span><div><h2>Need immediate help?</h2><p>Report an emergency to your response team.</p></div></div><a class="btn red big" href="{{ route('alerts.create') }}">SEND EMERGENCY ALERT →</a></div>
<div class="stats"><div class="stat blue"><span>🚨</span><div><small>Active Alerts</small><strong>{{ $active }}</strong></div></div><div class="stat green"><span>✓</span><div><small>Resolved Alerts</small><strong>{{ $resolved }}</strong></div></div></div>
<section class="panel"><div class="panel-head"><h2>Emergency Types</h2><a href="{{ route('alerts.create') }}">View all →</a></div><div class="quick-grid">@foreach(['🚑 Medical','🔥 Fire','🌊 Flood','🚗 Accident','🌪️ Disaster','🚨 Crime','🆘 Rescue','⚠️ Other'] as $c)<a href="{{ route('alerts.create') }}" class="quick">{{ $c }}</a>@endforeach</div></section>
<section class="panel"><div class="panel-head"><h2>Recent Alerts</h2><a href="{{ route('alerts.index') }}">View all →</a></div>
<table><tr><th>Reference</th><th>Type</th><th>Location</th><th>Status</th><th></th></tr>
@forelse($recent as $a)<tr><td>{{ $a->reference_number }}</td><td>{{ $a->emergency_type }}</td><td>{{ $a->location }}</td><td><span class="status {{ $a->status }}">{{ $a->statusLabel() }}</span></td><td><a href="{{ route('alerts.show',$a) }}">View</a></td></tr>@empty<tr><td colspan="5" class="empty">No alerts yet.</td></tr>@endforelse
</table></section>
@endsection
