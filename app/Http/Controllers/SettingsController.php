<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Exception;

class SettingsController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('settings.index', compact('admin'));
    }

    public function update(Request $request)
    {
        try {
            $admin = Admin::find(Auth::guard('admin')->id());

            if (!$admin) {
                return back()->with('error', 'Data admin tidak ditemukan.');
            }
            
            $validated = $request->validate([
                'fullname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
                'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
                'phone_number' => 'nullable|string|max:20',
                'bio' => 'nullable|string',
                'address' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'nullable|string|min:8|confirmed',
            ], [
                'fullname.required' => 'Nama lengkap wajib diisi.',
                'username.required' => 'Username wajib diisi.',
                'username.unique'   => 'Username sudah digunakan.',
                'email.required'    => 'Email wajib diisi.',
                'email.email'       => 'Format email tidak valid.',
                'email.unique'      => 'Email sudah digunakan.',
                'photo.image'       => 'File harus berupa gambar.',
                'photo.mimes'       => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'photo.max'         => 'Ukuran foto tidak boleh lebih dari 2 MB.',
                'password.min'      => 'Password minimal 8 karakter.',
                'password.confirmed'=> 'Konfirmasi password tidak sesuai.',
            ]);

            if ($request->hasFile('photo')) {
                if ($admin->photo && Storage::exists('public/photos/' . $admin->photo)) {
                    Storage::delete('public/photos/' . $admin->photo);
                }
                
                $photoName = time() . '.' . $request->photo->extension();
                $request->photo->storeAs('public/photos', $photoName);
                $validated['photo'] = $photoName;
            }

            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $update = $admin->update($validated);

            if ($update) {
                return back()->with('success', 'Profil berhasil diperbarui.');
            } else {
                return back()->with('error', 'Profil gagal diperbarui.');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Profil gagal diperbarui. Kesalahan: ' . $e->getMessage());
        }
    }
}
