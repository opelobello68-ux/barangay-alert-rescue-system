@extends('layouts.app')
@section('content')
<div class="page-head"><div><span class="eyebrow">RESPONDER PORTAL</span><h1>Response Dashboard</h1><p>Review active alerts and update your response.</p></div></div>
<div class="stats"><div class="stat redstat"><span>🚨</span><div><small>Active Alerts</small><strong>{{ $active->count() }}</strong></div></div><div class="stat blue"><span>🚑</span><div><small>Responding</small><strong>{{ $responding }}</strong></div></div><div class="stat green"><span>✓</span><div><small>Resolved by Me</small><strong>{{ $resolved }}</strong></div></div></div>
<div class="panel"><div class="panel-head"><h2>Active Alerts</h2></div><table><tr><th>Reference</th><th>Type</th><th>Location</th><th>Status</th><th>Action</th></tr>@forelse($active as $a)<tr><td>{{ $a->reference_number }}</td><td>{{ $a->emergency_type }}</td><td>{{ $a->location }}</td><td><span class="status {{ $a->status }}">{{ $a->statusLabel() }}</span></td><td><a class="btn small blue" href="{{ route('responder.alerts.show',$a) }}">View / Respond</a></td></tr>@empty<tr><td colspan="5" class="empty">No active alerts.</td></tr>@endforelse</table></div>
@endsection
