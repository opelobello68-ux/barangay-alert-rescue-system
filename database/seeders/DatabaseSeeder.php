<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EmergencyCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email'=>'admin@bars.test'], [
            'name'=>'BARS Administrator','password'=>Hash::make('password'),
            'contact_number'=>'09170000000','address'=>'Barangay Office','role'=>'admin'
        ]);

        User::updateOrCreate(['email'=>'responder@bars.test'], [
            'name'=>'BARS Responder','password'=>Hash::make('password'),
            'contact_number'=>'09171111111','address'=>'Response Center','role'=>'responder'
        ]);

        User::updateOrCreate(['email'=>'resident@bars.test'], [
            'name'=>'Juan Dela Cruz','password'=>Hash::make('password'),
            'contact_number'=>'09172222222','address'=>'Sample Community','role'=>'resident'
        ]);

        foreach ([
            ['Medical Emergency','🚑','Medical assistance'],
            ['Fire Incident','🔥','Fire or smoke emergency'],
            ['Flood Emergency','🌊','Flooding or water-related emergency'],
            ['Accident','🚗','Road or vehicular accident'],
            ['Disaster','🌪️','Earthquake, landslide, typhoon or disaster'],
            ['Crime Incident','🚨','Crime or safety emergency'],
            ['Rescue Operation','🆘','Person or animal requiring rescue'],
            ['Other Emergency','⚠️','Other urgent emergency'],
        ] as [$name,$icon,$desc]) {
            EmergencyCategory::updateOrCreate(['name'=>$name],[
                'icon'=>$icon,'description'=>$desc,'active'=>true
            ]);
        }
    }
}
