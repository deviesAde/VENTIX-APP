<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Organizer;
use App\Models\Event;
use App\Models\Payment;

class AdminProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profil.
     */

     public function index()
     {
         $user = Auth::user();
         $organizerCount = Organizer::count();
         $eventCount = Event::count();
         $paymentCount = Payment::where('status', 'pending')->count();

         // Get organizers count by month
         $organizersByMonth = Organizer::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
             ->whereYear('created_at', date('Y'))
             ->groupBy('month')
             ->orderBy('month')
             ->get()
             ->pluck('count', 'month')
             ->toArray();

         // Get events count by month
         $eventsByMonth = Event::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
             ->whereYear('created_at', date('Y'))
             ->groupBy('month')
             ->orderBy('month')
             ->get()
             ->pluck('count', 'month')
             ->toArray();

         // Fill in missing months with 0
         $allMonths = range(1, 12);
         $organizersData = array_replace(array_fill_keys($allMonths, 0), $organizersByMonth);
         $eventsData = array_replace(array_fill_keys($allMonths, 0), $eventsByMonth);

         return view('admin.dashboard', compact(
             'user',
             'organizerCount',
             'eventCount',
             'paymentCount',
             'organizersData',
             'eventsData'
         ));
     }
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update profil pengguna.
     */
    public function update(Request $request)
    {
        // Pastikan kita mengambil user dari model User
        $user = User::find(Auth::id());

        // Validasi input
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $user->id,
            'current_password'  => 'nullable|string|min:8',
            'password'          => 'nullable|string|min:8|confirmed',
        ]);

        // Periksa password lama jika ada perubahan password
        if ($request->current_password && !Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors([
                'current_password' => 'Password saat ini salah.',
            ]);
        }

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Simpan perubahan

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
