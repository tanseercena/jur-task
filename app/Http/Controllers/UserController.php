<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'user' => auth()->user(),
            'experiences' => auth()->user()->experiences,
        ]);
    }

    public function updateProfile(ProfileRequest $request)
    {
        auth()->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }


}
