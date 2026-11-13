@extends('layouts.app')
@section('content')
<div class="page-head"><div><span class="eyebrow">RESPOND TO ALERT</span><h1>{{ $alert->emergency_type }}</h1><p>{{ $alert->reference_number }}</p></div><span class="status {{ $alert->status }}">{{ $alert->statusLabel() }}</span></div>
<div class="detail-grid"><div class="panel"><h2>Emergency Details</h2><p><b>Resident:</b> {{ $alert->user->name }}</p><p><b>Contact:</b> {{ $alert->user->contact_number }}</p><p><b>Location:</b> {{ $alert->location }}</p><p><b>Description:</b><br>{{ $alert->description }}</p>@if($alert->photo)<img class="evidence" src="{{ asset('storage/'.$alert->photo) }}">@endif</div>
<div class="panel"><h2>Update Response</h2><form method="POST" action="{{ route('responder.alerts.status',$alert) }}">@csrf @method('PATCH')
<label>Status</label><select name="status"><option value="accepted">Accept Alert</option><option value="on_the_way">On the Way</option><option value="arrived">Arrived</option><option value="resolving">In Rescue</option><option value="resolved">Resolved</option></select>
<label>Remarks</label><textarea name="remarks" rows="5" placeholder="Optional response note"></textarea>
<button class="btn blue full">Update Response Status</button></form></div></div>
@endsection
