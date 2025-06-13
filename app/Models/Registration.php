<?php

// app/Models/Registration.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'ticket_number',
        'status'
    ];

    public function registrations()
{
    return $this->hasMany(Registration::class);
}

public function attendees()
{
    return $this->belongsToMany(User::class, 'event_registrations')
                ->withPivot('ticket_number', 'status')
                ->withTimestamps();
}
}
