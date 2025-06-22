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
        'snap_token',
        'paid_at',
        'created_at',
        'updated_at',
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
