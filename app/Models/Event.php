<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guest;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function guest(){
        return $this->hasMany(Guest::class);
    }
    public function PurcheseTickets() {
        return $this->belongsToMany(User::class, 'events_users_tickets')
        ->withPivot('ticket_id', 'purchese_made')
        ->withTimestamps();
    }
    public function ticket() {
        return $this->hasOne(Ticket::class);
    }
}
