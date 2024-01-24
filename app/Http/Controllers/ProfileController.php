<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;

class ProfileController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        return view('auth.profile', compact('categories'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
        ];

        if ($request->hasFile('profile')) {
            $data['profile'] = $request->file('profile')->store('profiles', 'public');
        }

        auth()->user()->update($data);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
