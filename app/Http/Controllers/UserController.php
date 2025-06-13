<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $events = Event::where('status', 'published')
            ->with('organizer')
            ->orderBy('start_time', 'asc')
            ->paginate(12);

        return view('user.dashboard', compact('events'));
    }

    public function show(Event $event)
    {
        $isRegistered = false;

        if (Auth::check()) {  // Proper way to check authentication
            $isRegistered = $event->attendees()->where('user_id', Auth::id())->exists();
        }

        return view('user.show', [
            'event' => $event,
            'isRegistered' => $isRegistered
        ]);
    }

}
