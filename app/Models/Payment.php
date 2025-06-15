<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'event_registration_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
    ];

    public function eventRegistration()
    {
        return $this->belongsTo(EventRegistration::class);
    }
    public function isPaid()
    {
        return $this->status === 'paid';
    }

}
