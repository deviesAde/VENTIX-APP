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
        'status',
    ];

    // Relasi ke Organizer
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function tickets()
{
    return $this->hasMany(Ticket::class);
}
}
