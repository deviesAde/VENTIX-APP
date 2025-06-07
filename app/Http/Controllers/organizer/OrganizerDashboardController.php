<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Validation\Rule;

class OrganizerDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard organizer.
     */
    public function index()
    {
        $user = Auth::user();
        $events = Event::where('organizer_id', $user->id)->get();

        return view('organizer.dashboard', [
            'user' => $user,
            'events' => $events,
        ]);
    }

    // public function storeEvent(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'location' => 'required|string|max:255',
    //         'start_time' => 'required|date',
    //         'end_time' => 'required|date|after:start_time',
    //         'banner' => 'nullable|image|max:2048',
    //         'tickets' => 'nullable|array',
    //         'tickets.*.name' => 'required_with:tickets|string|max:255',
    //         'tickets.*.price' => 'required_with:tickets|numeric|min:0',
    //         'tickets.*.quantity' => 'required_with:tickets|integer|min:1',
    //         'tickets.*.end_date' => 'required_with:tickets|date|after_or_equal:start_time',
    //     ]);

    //     // Upload banner jika ada
    //     $bannerPath = null;
    //     if ($request->hasFile('banner')) {
    //         $bannerPath = $request->file('banner')->store('event-banners', 'public');
    //     }

    //     // Simpan event
    //     $event = Event::create([
    //         'organizer_id' => Auth::id(),
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'location' => $request->location,
    //         'start_time' => $request->start_time,
    //         'end_time' => $request->end_time,
    //         'banner_path' => $bannerPath,
    //         'status' => $request->has('publish') ? 'published' : 'draft',
    //     ]);

    //     // Simpan tiket jika ada
    //     if ($request->has('tickets')) {
    //         foreach ($request->tickets as $ticket) {
    //             Ticket::create([
    //                 'event_id' => $event->id,
    //                 'ticket_type' => $ticket['name'],
    //                 'price' => $ticket['price'],
    //                 'quantity' => $ticket['quantity'],
    //                 'status' => 'available',
    //                 'end_date' => $ticket['end_date'],
    //             ]);
    //         }
    //     }

    //     return redirect()->route('organizer.events')->with('success', 'Event berhasil disimpan!');
    // }


}
