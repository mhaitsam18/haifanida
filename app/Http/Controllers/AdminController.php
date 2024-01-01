<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Dashboard',
            'page' => 'index',
        ]);
    }
    public function profile()
    {
        return view('admin.profile', [
            'title' => 'Profil Saya',
            'page' => 'index',
        ]);
    }
    public function profileUpdate(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
        ]);

        // Assign custom attribute names:
        $validator->customAttributes = [
            'name' => 'Nama Lengkap',
            'username' => 'Nama Pengguna',
            'phone_number' => 'Nomor Ponsel',
            'photo' => 'Foto',
        ];


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Terjadi kesalahan dalam pengisian formulir.')
                ->withInput();
        }
        $user = User::find($request->id);
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        $user->name = $request->input('name');
        $user->email = strtolower($request->input('email'));
        $user->username = strtolower($request->input('username'));
        $user->phone_number = $request->input('phone_number');
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('user-photo');
            $user->photo = $path;
        }
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function passwordUpdate(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Terjadi kesalahan dalam pengisian formulir.')
                ->withInput();
        }

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()
                ->with('error', 'Password saat ini tidak cocok.')
                ->withInput();
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    public function pusat()
    {
    }
    public function cabang()
    {
    }
    public function perwakilan()
    {
    }
}
