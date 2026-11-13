@extends('layouts.app')
@section('content')
<div class="page-head"><div><span class="eyebrow">ALERT MANAGEMENT</span><h1>Alerts & Incidents</h1><p>Review emergency reports and assign responders.</p></div></div>
<div class="panel"><table><tr><th>Reference</th><th>Resident</th><th>Emergency</th><th>Location</th><th>Status</th><th>Responder</th><th>Action</th></tr>
@forelse($alerts as $a)<tr><td>{{ $a->reference_number }}</td><td>{{ $a->user->name }}</td><td>{{ $a->emergency_type }}</td><td>{{ $a->location }}</td><td><span class="status {{ $a->status }}">{{ $a->statusLabel() }}</span></td><td>{{ $a->responder?->name ?? 'Unassigned' }}</td><td><details><summary>Assign</summary><form class="inline" method="POST" action="{{ route('admin.alerts.assign',$a) }}">@csrf @method('PATCH')<select name="responder_id" required><option value="">Choose responder</option>@foreach($responders as $r)<option value="{{ $r->id }}">{{ $r->name }}</option>@endforeach</select><button class="btn small blue">Assign</button></form></details></td></tr>@empty<tr><td colspan="7" class="empty">No alerts.</td></tr>@endforelse</table>{{ $alerts->links() }}</div>
@endsection
