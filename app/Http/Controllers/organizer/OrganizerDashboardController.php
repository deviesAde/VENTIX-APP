<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class OrganizerDashboardController extends Controller
{


    public function showScanPage()
{
    return view('organizer.scan'); // Halaman scanner
}
public function verifyTicket(Request $request)
{
    $validator = Validator::make($request->all(), [
        'ticket_code' => 'required|string',
        'proof_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422);
    }

    DB::beginTransaction();
    try {
        $ticket = EventRegistration::with(['user', 'event'])
            ->where('ticket_number', $request->ticket_code)
            ->firstOrFail();

        if ($ticket->isCheckedIn()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Ticket already checked in',
                'data' => $this->formatTicketData($ticket)
            ]);
        }

        $ticket->checkIn($request->file('proof_image'));
        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Check-in successful',
            'data' => $this->formatTicketData($ticket)
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => 'Ticket not found'
        ], 404);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred',
            'error' => $e->getMessage()
        ], 500);
    }
}

    private function formatTicketData($ticket)
    {
        return [
            'ticket' => $ticket,
            'user' => $ticket->user,
            'event' => $ticket->event,
            'checked_in_at' => $ticket->checked_in_at?->format('Y-m-d H:i:s'),
            'proof_image_url' => $ticket->proof_image_url,
            'remaining_tickets' => $ticket->event->ticket_quantity,
            'qr_code' => $ticket->getQrCodeBase64()
        ];
    }



    public function storeEvent(Request $request)
{
    $request->validate([
        'title'           => 'required|string|max:255',
        'description'     => 'nullable|string',
        'location'        => 'required|string|max:255',
        'start_time'      => 'required|date',
        'end_time'        => 'required|date|after:start_time',
        'banner'          => 'nullable|image|max:2048',
        'event_type'      => ['required', Rule::in(['free', 'paid'])],
        'ticket_quantity' => 'required_if:event_type,paid|nullable|integer|min:1',
        'ticket_price'    => 'required_if:event_type,paid|nullable|numeric|min:0',
        'status'          => ['nullable', Rule::in(['draft', 'published'])],
        'category'        => ['required', Rule::in(['music', 'seminar', 'sports', 'technology', 'art'])],
    ]);

    $bannerPath = null;
    if ($request->hasFile('banner')) {
        $bannerPath = $request->file('banner')->store('event-banners', 'public');
    }


    $event = Event::create([
        'organizer_id'    => Auth::id(),
        'title'           => $request->title,
        'description'     => $request->description,
        'location'        => $request->location,
        'start_time'      => $request->start_time,
        'end_time'        => $request->end_time,
        'banner_path'     => $bannerPath,
        'event_type'      => $request->event_type,
        'ticket_quantity' => $request->event_type === 'paid' ? $request->ticket_quantity : null,
        'ticket_price'    => $request->event_type === 'paid' ? $request->ticket_price : null,
        'status'          => $request->has('publish') ? 'published' : 'draft',
        'category'        => $request->category,
    ]);

    if ($request->ajax()) {
        // Jika request AJAX, kembalikan response JSON
        return response()->json([
            'success' => true,
            'message' => 'Event berhasil dibuat'
        ]);
    }

    // Jika request biasa, redirect
    return redirect()->route('organizer.dashboard')->with('success', 'Event berhasil dibuat!');
}
public function dashboard()
{
    {
        $organizerId = Auth::id();

        $totalEvents = Event::where('organizer_id', $organizerId)->count();


        $paidEvents = Event::where('organizer_id', $organizerId)
            ->where('event_type', 'paid')
            ->get();

        $ticketsSold = $paidEvents->sum('ticket_quantity');
        $totalRevenue = $paidEvents->sum(function($event) {
            return $event->ticket_quantity * $event->ticket_price;
        });

        $upcomingEvents = Event::where('organizer_id', $organizerId)
            ->where('start_time', '>=', now())
            ->where('start_time', '<=', now()->addDays(30))
            ->orderBy('start_time')
            ->get()
            ->map(function($event) {
                // Convert

                $startTime = is_string($event->start_time)
                    ? Carbon::parse($event->start_time)
                    : $event->start_time;

                if ($event->event_type === 'paid') {
                    $ticketInfo = $event->ticket_quantity . ' tickets available';
                    $revenue = 'Rp ' . number_format($event->ticket_quantity * $event->ticket_price, 0, ',', '.');
                } else {
                    $ticketInfo = 'Free Event';
                    $revenue = 'Rp 0';
                }

                return [
                    'name' => $event->title,
                    'date' => $startTime->format('d F Y'),
                    'time' => $startTime->format('H:i'),
                    'location' => $event->location,
                    'tickets' => $ticketInfo,
                    'revenue' => $revenue,
                    'type' => $event->event_type,
                    'category' => $event->category
                ];
            });

        return view('organizer.dashboard', [
            'totalEvents' => $totalEvents,
            'ticketsSold' => $ticketsSold,
            'totalRevenue' => $totalRevenue,
            'upcomingEvents' => $upcomingEvents
        ]);
    }
}
public function create()
{
    return view('organizer.create-event');
}


public function index()
{
    $events = Event::where('organizer_id', Auth::id())->get();
    return view('organizer.events', compact('events'));
}




public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'location' => 'required|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after_or_equal:start_time',
        'event_type' => 'required|in:free,paid',
        'ticket_quantity' => 'nullable|integer',
        'ticket_price' => 'nullable|numeric',
        'category' => 'required|in:music,seminar,sports,technology,art',
        'status' => 'required|in:draft,published',

    ]);

    $event = Event::findOrFail($id);
    $event->update([
        'title' => $request->title,
        'description' => $request->description,
        'location' => $request->location,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'event_type' => $request->event_type,
        'ticket_quantity' => $request->event_type === 'paid' ? $request->ticket_quantity : null,
        'ticket_price' => $request->event_type === 'paid' ? $request->ticket_price : null,
        'category' => $request->category,
        'status' => $request->status,
    ]);

    return redirect()->route('organizer.events')->with('success', 'Event berhasil diperbarui.');
}

public function destroy($id)
{
    $event = Event::findOrFail($id);
    $event->delete();

    return redirect()->back()->with('success', 'Event berhasil diperbarui.');
}

//profile

}




