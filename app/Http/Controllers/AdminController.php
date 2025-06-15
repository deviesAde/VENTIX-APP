<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin.events.index'); // Create a Blade file: resources/views/admin/dashboard.blade.php
    }

    public function approveOrganizer($organizerId)
{
    $organizer = Organizer::findOrFail($organizerId);

    // Buat user di tabel users
    $user = User::create([
        'name'     => $organizer->organization_name,
        'email'    => $organizer->email,
        'password' => Hash::make(Str::random(8)), // Buat password acak
        'role'     => 'organizer',
    ]);

    // Update organizer dengan user_id dan status
    $organizer->update([
        'user_id' => $user->id,
        'status'  => 'approved',
    ]);

    return redirect()->route('admin.organizers')
        ->with('success', 'Organizer berhasil disetujui!');
}
public function rejectOrganizer($organizerId)
{
    $organizer = Organizer::findOrFail($organizerId);

    // Update status menjadi rejected
    $organizer->update([
        'status' => 'rejected',
    ]);

    return redirect()->route('admin.organizers')
        ->with('success', 'Organizer berhasil ditolak!');
}
public function deleteOrganizer($organizerId)
{
    $organizer = Organizer::findOrFail($organizerId);

    // Hapus organizer
    $organizer->delete();

    return redirect()->route('admin.organizers')
        ->with('success', 'Organizer berhasil dihapus!');
}
}
