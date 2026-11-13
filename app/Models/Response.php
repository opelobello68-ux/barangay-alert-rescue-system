<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = ['alert_id','responder_id','status','remarks'];
    public function alert() { return $this->belongsTo(EmergencyAlert::class, 'alert_id'); }
    public function responder() { return $this->belongsTo(User::class, 'responder_id'); }
}
