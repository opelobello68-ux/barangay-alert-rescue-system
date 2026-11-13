<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmergencyAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number','user_id','emergency_type','description',
        'location','latitude','longitude','photo','status','responder_id'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function responder() { return $this->belongsTo(User::class, 'responder_id'); }

    public function statusLabel(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'accepted' => 'Accepted',
            'on_the_way' => 'On the Way',
            'arrived' => 'Arrived',
            'resolving' => 'In Rescue',
            'resolved' => 'Resolved',
            default => ucfirst(str_replace('_',' ',$this->status)),
        };
    }
}
