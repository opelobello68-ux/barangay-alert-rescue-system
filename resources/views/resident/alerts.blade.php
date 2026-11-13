@extends('layouts.app')
@section('content')
<div class="page-head"><div><span class="eyebrow">MY REPORTS</span><h1>My Alerts</h1><p>Track your submitted emergency reports.</p></div><a class="btn red" href="{{ route('alerts.create') }}">+ Send Alert</a></div>
<div class="panel"><table><tr><th>Reference</th><th>Emergency</th><th>Location</th><th>Date</th><th>Status</th><th>Action</th></tr>
@forelse($alerts as $a)<tr><td><b>{{ $a->reference_number }}</b></td><td>{{ $a->emergency_type }}</td><td>{{ $a->location }}</td><td>{{ $a->created_at->format('M d, Y h:i A') }}</td><td><span class="status {{ $a->status }}">{{ $a->statusLabel() }}</span></td><td><a href="{{ route('alerts.show',$a) }}">Track</a></td></tr>@empty<tr><td colspan="6" class="empty">No reports yet.</td></tr>@endforelse</table>{{ $alerts->links() }}</div>
@endsection
