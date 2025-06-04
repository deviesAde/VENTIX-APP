<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    // Tentukan tabel jika berbeda dari nama model
    protected $table = 'organizers';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'name',
        'email',
        'phone',
        'organization_name',
        'description',
        'website',
        'logo_path',
        'status',
        'user_id',
    ];

    // Contoh relasi: Organizer memiliki banyak Event
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
