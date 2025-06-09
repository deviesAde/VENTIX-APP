<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class SalesStatsController extends Controller
{
    public function index()
    {
        $organizerId = Auth::id();

        // Hitung total event
        $totalEvents = Event::where('organizer_id', $organizerId)
            ->where('event_type', 'paid')
            ->count();

        // Hitung total tiket yang tersedia (bukan terjual)
        $totalTickets = Event::where('organizer_id', $organizerId)
            ->where('event_type', 'paid')
            ->sum('ticket_quantity');

        // Hitung total pendapatan potensial
        $totalRevenue = Event::where('organizer_id', $organizerId)
            ->where('event_type', 'paid')
            ->sum(DB::raw('ticket_quantity * ticket_price'));

        // Hitung rata-rata harga tiket
        $avgTicketPrice = Event::where('organizer_id', $organizerId)
            ->where('event_type', 'paid')
            ->avg('ticket_price');

        // Ambil data event untuk dropdown filter
        $events = Event::where('organizer_id', $organizerId)
            ->where('event_type', 'paid')
            ->get(['id', 'title']);

        // Data untuk grafik (contoh: penjualan per bulan)
        $monthlySales = Event::where('organizer_id', $organizerId)
            ->where('event_type', 'paid')
            ->selectRaw('YEAR(start_time) as year, MONTH(start_time) as month, SUM(ticket_quantity) as tickets')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Format data untuk chart
        $chartData = $monthlySales->map(function($item) {
            return [
                'month' => Carbon::create($item->year, $item->month)->format('M Y'),
                'tickets' => $item->tickets
            ];
        });

        return view('organizer.statistics', [
            'totalEvents' => $totalEvents,
            'totalTickets' => $totalTickets,
            'totalRevenue' => $totalRevenue,
            'avgTicketPrice' => $avgTicketPrice,
            'events' => $events,
            'chartData' => $chartData
        ]);
    }
}
