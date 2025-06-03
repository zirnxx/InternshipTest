<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Http\Requests\Admin\PasswordUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            return redirect()->route('admin.login');
        }
        return view('admin.profile.show', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->update($request->validated());
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }

    public function editPassword()
    {
        return view('admin.profile.edit-password');
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->route('admin.profile')->with('success', 'Password updated successfully!');
    }
}