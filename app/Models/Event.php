<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'banner_path',
        'event_type',
        'ticket_quantity',
        'ticket_price',
        'status',
        'category',
    ];

    // Relasi ke Organizer
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function attendees()
{
    return $this->belongsToMany(User::class, 'event_registrations')
                ->withPivot('ticket_number', 'status')
                ->withTimestamps();
}

public function registrations()
{
    return $this->hasMany(Registration::class);
}


}
