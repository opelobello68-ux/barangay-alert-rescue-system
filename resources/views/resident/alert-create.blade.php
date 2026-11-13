@extends('layouts.app')
@section('content')
<div class="page-head"><div><span class="eyebrow">EMERGENCY REPORT</span><h1>Send Emergency Alert</h1><p>Provide accurate information so responders can act quickly.</p></div></div>
<div class="form-card">
<form method="POST" action="{{ route('alerts.store') }}" enctype="multipart/form-data">@csrf
<label>Emergency Type</label><div class="type-grid">@foreach($categories as $c)<label class="type-option"><input type="radio" name="emergency_type" value="{{ $c->name }}" required><span>{{ $c->icon }}<b>{{ $c->name }}</b></span></label>@endforeach</div>
<label>Location</label><input name="location" placeholder="Zone / Purok / Street / Landmark" required>
<div class="two"><div><label>Latitude (optional)</label><input name="latitude" type="number" step="any"></div><div><label>Longitude (optional)</label><input name="longitude" type="number" step="any"></div></div>
<label>Description</label><textarea name="description" rows="5" placeholder="Describe what happened, who needs help, and any important details." required></textarea>
<label>Photo / Evidence (optional)</label><input type="file" name="photo" accept="image/*">
<div class="notice">⚠️ Only submit genuine emergencies. False or abusive alerts may delay help for others.</div>
<button class="btn red big full">🚨 SEND ALERT</button>
</form></div>
@endsection
