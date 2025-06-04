<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class OrganizerDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard organizer.
     */
    public function index()
    {
        // Ambil ID organizer yang sedang login
        $organizerId = Auth::user()->id;

        // Hitung total event yang diajukan oleh organizer
        $totalEvents = Event::where('organizer_id', $organizerId)->count();

        // Hitung event yang disetujui
        $approvedEvents = Event::where('organizer_id', $organizerId)
            ->where('status', 'approved')
            ->count();

        // Hitung event yang ditolak
        $rejectedEvents = Event::where('organizer_id', $organizerId)
            ->where('status', 'rejected')
            ->count();

        // Hitung total tiket yang terjual
        $totalTicketsSold = Event::where('organizer_id', $organizerId)
            ->sum('tickets_sold'); // Pastikan kolom `tickets_sold` ada di tabel `events`

        // Ambil event terbaru
        $recentEvents = Event::where('organizer_id', $organizerId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data untuk grafik penjualan tiket
        $salesData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'], // Contoh data bulan
            'data' => [10, 20, 15, 30, 25], // Contoh data penjualan tiket
        ];

        return view('organizer.dashboard', compact(
            'totalEvents',
            'approvedEvents',
            'rejectedEvents',
            'totalTicketsSold',
            'recentEvents',
            'salesData'
        ));
    }
}
