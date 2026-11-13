<?php

namespace App\Http\Controllers;

use App\Models\EmergencyAlert;
use App\Models\EmergencyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlertController extends Controller
{
    public function residentDashboard()
    {
        $user = auth()->user();
        $active = $user->alerts()->where('status','!=','resolved')->count();
        $resolved = $user->alerts()->where('status','resolved')->count();
        $recent = $user->alerts()->latest()->take(5)->get();
        return view('resident.dashboard', compact('active','resolved','recent'));
    }

    public function create()
    {
        $categories = EmergencyCategory::where('active',1)->orderBy('name')->get();
        return view('resident.alert-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'emergency_type' => ['required','string','max:80'],
            'description' => ['required','string','max:2000'],
            'location' => ['required','string','max:255'],
            'latitude' => ['nullable','numeric'],
            'longitude' => ['nullable','numeric'],
            'photo' => ['nullable','image','max:5120'],
        ]);

        $data['user_id'] = auth()->id();
        $data['reference_number'] = 'BARS-'.now()->format('Ymd').'-'.strtoupper(Str::random(5));
        $data['status'] = 'pending';

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('alerts','public');
        }

        $alert = EmergencyAlert::create($data);

        return redirect()->route('alerts.show', $alert)->with('success','Emergency alert sent successfully.');
    }

    public function index()
    {
        $alerts = auth()->user()->alerts()->latest()->paginate(10);
        return view('resident.alerts', compact('alerts'));
    }

    public function show(EmergencyAlert $alert)
    {
        abort_unless($alert->user_id === auth()->id(), 403);
        return view('resident.alert-show', compact('alert'));
    }
}
