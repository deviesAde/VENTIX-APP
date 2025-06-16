<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventRegistrationController extends Controller
{
    // ... other methods

    /**
     * Show the scanner interface
     */
    public function showScanner()
    {
        return view('organizer.scan');
    }

    /**
     * Verify a scanned ticket
     */
    public function verifyTicket(Request $request)
    {
        $request->validate([
            'ticket_data' => 'required|string'
        ]);

        try {
            $data = json_decode($request->ticket_data, true);

            $registration = EventRegistration::with(['event', 'user'])
                ->where('id', $data['registration_id'] ?? null)
                ->where('ticket_number', $data['ticket_number'] ?? null)
                ->where('event_id', $data['event_id'] ?? null)
                ->where('user_id', $data['user_id'] ?? null)
                ->first();

            if (!$registration) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket not found or invalid'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'registration' => $registration,
                'user' => $registration->user,
                'event' => $registration->event,
                'is_checked_in' => $registration->isCheckedIn(),
                'qr_code' => $registration->generateQrCode()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing ticket: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check in a ticket
     */
    public function checkIn(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:event_registrations,id'
        ]);

        $registration = EventRegistration::find($request->registration_id);

        if ($registration->isCheckedIn()) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket already checked in at ' . $registration->checked_in_at->format('Y-m-d H:i:s')
            ]);
        }

        $registration->checkIn();

        return response()->json([
            'success' => true,
            'message' => 'Ticket checked in successfully',
            'checked_in_at' => $registration->checked_in_at->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Show manual entry form
     */
    public function showManualEntry()
    {
        return view('organizer.scan-manual');
    }

    /**
     * Process manual ticket entry
     */
    public function processManualEntry(Request $request)
    {
        $request->validate([
            'ticket_number' => 'required|string'
        ]);

        $registration = EventRegistration::with(['event', 'user'])
            ->where('ticket_number', $request->ticket_number)
            ->first();

        if (!$registration) {
            return back()->with('error', 'Ticket not found');
        }

        return view('organizer.scan-result', [
            'registration' => $registration,
            'is_checked_in' => $registration->isCheckedIn(),
            'from_manual' => true
        ]);
    }
}
