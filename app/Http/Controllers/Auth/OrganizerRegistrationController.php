<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'organization_name' => ['required', 'string', 'max:255'], // Additional field for organizer
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pending_organizer', // Organizer role pending approval
            'organization_name' => $request->organization_name, // Save organization name
        ]);

        return redirect()->route('login')->with('status', 'Your registration as an organizer is pending approval by the admin.');
    }
}
