<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>BARS</title><link rel="stylesheet" href="{{ asset('css/bars.css') }}"></head>
<body class="landing">
<header class="topbar"><div class="brand dark"><div class="logo">✚</div><div><b>BARS</b><small>Barangay Alert and Rescue System</small></div></div><nav><a href="#how">How it Works</a><a href="{{ route('login') }}">Login</a><a class="btn red" href="{{ route('register') }}">Register</a></nav></header>
<section class="hero">
<div class="hero-copy"><span class="pill">COMMUNITY EMERGENCY RESPONSE</span><h1>Fast Alert.<br><span>Fast Response.</span><br>Safer Community.</h1><p>A simple web-based platform for reporting emergencies, coordinating responders, and tracking rescue status.</p><a class="btn red big" href="{{ route('login') }}">🚨 Send Emergency Alert</a></div>
<div class="hero-art"><div class="circle">🚨</div><div class="rescue-card">🚑 <b>Emergency Response</b><small>Alert your response team quickly.</small></div><div class="rescue-card second">🧑‍🚒 <b>Responder Coordination</b><small>Track the response status.</small></div></div>
</section>
<section class="categories"><h2>Emergency Types</h2><div class="category-grid">
@foreach(['🚑 Medical','🔥 Fire','🌊 Flood','🚗 Accident','🌪️ Disaster','🚨 Crime','🆘 Rescue','⚠️ Other'] as $c)<div class="category">{{ $c }}</div>@endforeach
</div></section>
<section id="how" class="how"><h2>How BARS Works</h2><div class="steps"><div><b>1</b><h3>Send Alert</h3><p>Select the emergency and provide the location.</p></div><div><b>2</b><h3>Responder Receives</h3><p>The response team reviews and accepts the alert.</p></div><div><b>3</b><h3>Track Response</h3><p>Residents can follow the status until resolution.</p></div></div></section>
<footer>BARS — Barangay Alert and Rescue System</footer>
</body></html>
