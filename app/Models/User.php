<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Organizer; // Import Organizer model


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     *

     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Added role attribute
    ];
    protected $table = 'users';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function organizer()
{
    return $this->hasOne(Organizer::class);
}
public function registeredEvents()
{
    return $this->belongsToMany(Event::class, 'event_registrations')
                ->withPivot('ticket_number', 'status')
                ->withTimestamps();
}
public function registrations()
{
    return $this->hasMany(EventRegistration::class);
}
public function events()
{
    return $this->belongsToMany(Event::class, 'event_registrations', 'user_id', 'event_id')
                ->withTimestamps();
}
}
