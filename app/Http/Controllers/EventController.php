<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Transaction;

class EventController extends Controller
{
    public function show(Event $event)
    {
        $isRegistered = Auth::check() && $event->registrations()->where('user_id', Auth::id())->exists();

        return view('user.show', compact('event', 'isRegistered'));
    }

    public function register(Request $request, Event $event)
    {
        try {

            if ($event->registrations()->where('user_id', Auth::id())->exists()) {
                return back()->with('error', 'Anda sudah terdaftar untuk event ini');
            }

            $registration = EventRegistration::create([
                'event_id' => $event->id,
                'user_id' => Auth::id(),
            ]);


            if (!$event->isFree) {

                Config::$serverKey = config('services.midtrans.server_key');
                Config::$isProduction = config('services.midtrans.is_production');
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $params = [
                    'transaction_details' => [
                        'order_id' => $registration->ticket_number,
                        'gross_amount' => $event->ticket_price,
                    ],
                    'customer_details' => [
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    ],


                ];

                $snapToken = Snap::getSnapToken($params);


                Payment::create([
                    'event_registration_id' => $registration->id,
                    'amount' => $event->ticket_price,
                    'payment_method' => 'midtrans',
                    'status' => 'pending',
                    'transaction_id' => $registration->ticket_number,
                    'snap_token' => $snapToken,
                ]);


                return view('user.pay', [
                    'snapToken' => $snapToken,
                    'event' => $event,
                    'registration' => $registration
                ]);
            }


            return redirect()->route('events.ticket', $registration->id)
                ->with('success', 'Registrasi berhasil!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function ticket(EventRegistration $registration)
    {
        // Pastikan user yang melihat adalah pemilik tiket
        if (Auth::id() !== $registration->user_id) {
            abort(403);
        }

        return view('user.ticket', compact('registration'));
    }

    public function paymentCallback(Request $request)
    {
        Log::info('Callback Received:', $request->all());

        // Skip verification in development
        if (!app()->environment('production')) {
            $registration = EventRegistration::where('ticket_number', $request->order_id)->first();

            if ($registration) {
                $registration->update(['status' => 'confirmed']);
                $registration->payment?->update(['status' => 'paid']);
                return response()->json(['status' => 'success']);
            }

            return response()->json(['status' => 'error'], 404);
        }

  
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if ($hashed == $request->signature_key && $request->transaction_status == 'settlement') {
            $registration = EventRegistration::where('ticket_number', $request->order_id)->first();
            $registration?->update(['status' => 'confirmed']);
            $registration->payment?->update(['status' => 'paid']);
        }

        return response()->json(['status' => 'success']);
    }


    public function retryPayment(Payment $payment)
    {
        // Verify ownership
        if ($payment->eventRegistration->user_id !== Auth::id()) {
            abort(403);
        }

        // Setup Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');

        try {
            $params = [
                'transaction_details' => [
                    'order_id' => $payment->transaction_id,
                    'gross_amount' => $payment->amount,
                ],
                'customer_details' => [
                    'first_name' => $payment->eventRegistration->user->name,
                    'email' => $payment->eventRegistration->user->email,
                ]
            ];

            $snapToken = Snap::getSnapToken($params);


            $payment->update([
                'snap_token' => $snapToken,
                'payment_url' => Snap::getSnapUrl($params)
            ]);

            return view('user.pay', [
                'snapToken' => $snapToken,
                'event' => $payment->eventRegistration->event,
                'registration' => $payment->eventRegistration
            ]);

        } catch (\Exception $e) {
            Log::error('Payment retry failed: '.$e->getMessage());
            return back()->with('error', 'Payment processing error. Please try again.');
        }
    }




}
