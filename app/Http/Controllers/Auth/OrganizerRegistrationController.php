<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Organizer;
use Illuminate\Auth\Events\Registered;

class OrganizerRegistrationController extends Controller
{
    /**
     * Display the organizer registration view.
     */
    public function create()
    {
        return view('auth.register-organizer');
    }

    /**
     * Handle an incoming organizer registration request.
     */
    public function store(Request $request)
{
    $request->validate([
        'email'             => ['required', 'string', 'email', 'max:255', 'unique:organizers,email'],
        'organization_name' => ['required', 'string', 'max:255'],
        'description'       => ['nullable', 'string'],
        'phone'             => ['required', 'string', 'max:20'],
        'website'           => ['nullable', 'url', 'max:255'],
        'logo'              => ['nullable', 'image', 'max:2048'],
    ]);

    $logoPath = null;
    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = Str::slug($request->organization_name) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $logoPath = $file->storeAs('organizer-logos', $filename, 'public');
    }

    Organizer::create([
        'organization_name' => $request->organization_name,
        'description'       => $request->description,
        'phone'             => $request->phone,
        'website'           => $request->website,
        'logo_path'         => $logoPath,
        'status'            => 'pending',
        'email'             => $request->email,
    ]);

    return redirect()->route('login')
        ->with('success', 'Pendaftaran berhasil! Tunggu admin untuk meng-ACC dan cek email Anda secara berkala.');
}

}
