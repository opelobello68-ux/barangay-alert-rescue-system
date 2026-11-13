<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password','contact_number','address','role'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['password' => 'hashed'];

    public function alerts()
    {
        return $this->hasMany(EmergencyAlert::class);
    }
}
