@extends('layouts.app')
@section('content')
<div class="page-head"><div><span class="eyebrow">USER MANAGEMENT</span><h1>Users</h1><p>Residents, responders, and administrators.</p></div></div>
<div class="panel"><table><tr><th>Name</th><th>Email</th><th>Contact</th><th>Role</th><th>Address</th></tr>@foreach($users as $u)<tr><td>{{ $u->name }}</td><td>{{ $u->email }}</td><td>{{ $u->contact_number }}</td><td><span class="role">{{ ucfirst($u->role) }}</span></td><td>{{ $u->address }}</td></tr>@endforeach</table>{{ $users->links() }}</div>
@endsection
