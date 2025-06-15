<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with('organizer')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();
            return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting event: ' . $e->getMessage());
        }
    }
}
