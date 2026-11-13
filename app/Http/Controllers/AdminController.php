<?php

namespace App\Http\Controllers;

use App\Models\EmergencyAlert;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $active = EmergencyAlert::where('status','!=','resolved')->count();
        $responding = EmergencyAlert::whereIn('status',['accepted','on_the_way','arrived','resolving'])->count();
        $resolved = EmergencyAlert::where('status','resolved')->count();
        $total = EmergencyAlert::count();
        $recent = EmergencyAlert::with(['user','responder'])->latest()->take(8)->get();
        return view('admin.dashboard', compact('active','responding','resolved','total','recent'));
    }

    public function alerts()
    {
        $alerts = EmergencyAlert::with(['user','responder'])->latest()->paginate(15);
        $responders = User::where('role','responder')->orderBy('name')->get();
        return view('admin.alerts', compact('alerts','responders'));
    }

    public function assign(Request $request, EmergencyAlert $alert)
    {
        $data = $request->validate(['responder_id' => ['required','exists:users,id']]);
        $responder = User::where('id',$data['responder_id'])->where('role','responder')->firstOrFail();
        $alert->update(['responder_id'=>$responder->id,'status'=>'accepted']);
        return back()->with('success','Responder assigned successfully.');
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }
}
