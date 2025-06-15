<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Event;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class EventRegistration extends Model
{

    protected $fillable = ['event_id', 'user_id', 'ticket_number', 'status' ,];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getQrCodeBase64()
    {
        return 'data:image/png;base64,' . base64_encode(
            QrCode::format('png')
                ->size(200)
                ->generate(json_encode([
                    'event_id' => $this->event_id,
                    'ticket_number' => $this->ticket_number,
                    'user_id' => $this->user_id
                ]))
        );
    }

    /**
     * Get the proof image URL
     */
    public function getProofImageUrlAttribute()
    {
        return $this->proof_image ? Storage::url($this->proof_image) : null;
    }

    /**
     * Check if ticket has been checked in
     */
    public function isCheckedIn()
    {
        return !is_null($this->checked_in_at);
    }

    /**
     * Check-in the ticket
     */
    public function checkIn($proofImage = null)
    {
        $data = ['checked_in_at' => now()];

        if ($proofImage) {
            $path = $proofImage->store('proofs', 'public');
            $data['proof_image'] = $path;
        }

        $this->update($data);

        if (!$this->event->isFree) {
            $this->event->decrement('ticket_quantity');
        }

        return $this;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($registration) {
            $registration->ticket_number = 'TIX-' . strtoupper(Str::random(8));
            $registration->status = $registration->event->isFree ? 'confirmed' : 'pending';
        });
    }
}
