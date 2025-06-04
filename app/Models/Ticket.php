<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ticket extends Model
{
    //

    protected $fillable = [
        'event_id',
        'user_id',
        'ticket_type',
        'price',
        'quantity',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
