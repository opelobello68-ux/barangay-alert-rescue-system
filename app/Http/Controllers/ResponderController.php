<?php

namespace App\Http\Controllers;

use App\Models\EmergencyAlert;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponderController extends Controller
{
    public function dashboard()
    {
        $active = EmergencyAlert::whereIn('status',['pending','accepted','on_the_way','arrived','resolving'])->latest()->get();
        $resolved = EmergencyAlert::where('status','resolved')->where('responder_id',auth()->id())->count();
        $responding = EmergencyAlert::whereIn('status',['accepted','on_the_way','arrived','resolving'])->where('responder_id',auth()->id())->count();
        return view('responder.dashboard', compact('active','resolved','responding'));
    }

    public function show(EmergencyAlert $alert)
    {
        return view('responder.alert-show', compact('alert'));
    }

    public function updateStatus(Request $request, EmergencyAlert $alert)
    {
        $status = $request->validate([
            'status' => ['required','in:accepted,on_the_way,arrived,resolving,resolved'],
            'remarks' => ['nullable','string','max:1000']
        ]);

        $alert->update([
            'status' => $status['status'],
            'responder_id' => auth()->id(),
        ]);

        Response::create([
            'alert_id' => $alert->id,
            'responder_id' => auth()->id(),
            'status' => $status['status'],
            'remarks' => $status['remarks'] ?? null,
        ]);

        return back()->with('success','Response status updated.');
    }
}
