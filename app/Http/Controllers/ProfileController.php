<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Update profil pengguna (nama dan email)
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
