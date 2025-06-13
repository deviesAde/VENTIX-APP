<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Organizer;

class OrganizerProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
         $organizer = $user->organizer;

        return view('organizer.profile', compact('user', 'organizer'));
    }


public function update(Request $request)
{
    $user = Auth::user();
    $organizer = $user->organizer;

    $validated = $request->validate([
        'name'              => ['required', 'string', 'max:255'],
        'email'             => [
            'required',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id),
            Rule::unique('organizers')->ignore($organizer->id),
        ],
        'phone'             => ['required', 'string', 'max:20'],
        'organization_name' => ['required', 'string', 'max:255'],
        'website'           => ['nullable', 'url', 'max:255'],
        'description'       => ['nullable', 'string'],
        'logo'              => ['nullable', 'image', 'max:2048'],
        'current_password'  => ['nullable', 'required_with:new_password', 'current_password'],
        'new_password'      => ['nullable', 'string', 'min:8', 'confirmed'],
    ]);

    // Update User
    $user->name = $validated['name'];
    $user->email = $validated['email'];

    if (!empty($validated['new_password'])) {
        $user->password = Hash::make($validated['new_password']);
    }
    /** @var \App\Models\User $user **/
    $user->save();

    // Update Organizer
    $organizer->phone = $validated['phone'];
    $organizer->organization_name = $validated['organization_name'];
    $organizer->email = $validated['email'];
    $organizer->website = $validated['website'] ?? null;
    $organizer->description = $validated['description'] ?? null;

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = Str::slug($validated['organization_name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $logoPath = $file->storeAs('organizer-logos', $filename, 'public');

        if ($organizer->logo_path) {
            Storage::disk('public')->delete($organizer->logo_path);
        }

        $organizer->logo_path = $logoPath;
    }
    /** @var \App\Models\User $user **/
    $organizer->save();

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
            'logo_url' => $organizer->logo_path ? asset('storage/' . $organizer->logo_path) : null,
            'user_initials' => strtoupper(substr($user->name, 0, 1))
        ]);
    }

    return redirect()->route('organizer.profile')->with('success', 'Profil berhasil diperbarui!');
}

}
