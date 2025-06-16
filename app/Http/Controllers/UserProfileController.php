<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user */
        $user->loadCount([
            'events as upcoming_events_count' => fn($q) => $q->where('start_time', '>=', now()),
            'events as past_events_count' => fn($q) => $q->where('start_time', '<', now()),
        ]);

        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        /** @var \App\Models\User $user */
        $user->save();

        return response()->json([
            'success' => true,
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ]);
    }
}
