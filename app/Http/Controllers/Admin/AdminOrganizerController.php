<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrganizerStatusChanged;


class AdminOrganizerController extends Controller
{

    public function index(Request $request)
    {
        // Filter berdasarkan status jika ada
        $status = $request->get('status');
        $search = $request->get('search'); // Ambil input pencarian
        $query = Organizer::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('organization_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Pagination
        $organizers = $query->paginate(10);

        return view('admin.organizers.index', compact('organizers'));
    }

    /**
     * Approve organizer.
     */
    public function approve($id)
{
    $organizer = Organizer::findOrFail($id);

    // Cek apakah email sudah ada di tabel users
    if (User::where('email', $organizer->email)->exists()) {
        return redirect()->route('admin.organizers.index')
            ->with('error', 'Email sudah digunakan oleh user lain!');
    }

    // Generate password acak
    $password = Str::random(8);

    // Buat user
    $user = User::create([
        'name'     => $organizer->organization_name,
        'email'    => $organizer->email,
        'password' => Hash::make($password),
        'role'     => 'organizer',
    ]);

    // Update organizer
    $organizer->update([
        'user_id' => $user->id,
        'status'  => 'approved',
    ]);

    // Kirim email notifikasi
    Mail::to($organizer->email)->send(new OrganizerStatusChanged($organizer, 'approved', $password));

    return redirect()->route('admin.organizers.index')
        ->with('success', 'Organizer berhasil disetujui! Password telah dikirim melalui email.');
}

    /**
     * Reject organizer.
     */
    public function reject($id)
    {
        $organizer = Organizer::findOrFail($id);

        $organizer->update([
            'status' => 'rejected',
        ]);

        // Kirim email penolakan (tanpa password)
        Mail::to($organizer->email)->send(new OrganizerStatusChanged($organizer, 'rejected', null));

        return redirect()->route('admin.organizers.index')
            ->with('success', 'Organizer berhasil ditolak!');
    }

    /**
     * Hapus organizer.
     */
    public function destroy($id)
    {
        $organizer = Organizer::findOrFail($id);

        // Hapus organizer
        $organizer->delete();

        return redirect()->route('admin.organizers.index')
            ->with('success', 'Organizer berhasil dihapus!');
    }

    /**
     * Edit organizer.
     */
   // show detail
    public function show($id)
    {
        $organizer = Organizer::findOrFail($id);

        return view('admin.organizers.edit', compact('organizer'));
    }



}
