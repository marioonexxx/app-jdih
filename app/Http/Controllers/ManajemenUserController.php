<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    public function index()
    {
        // Hanya mengambil user dengan role operator
        $operators = User::where('role', 'operator')->latest()->get();
        return view('user-admin.manajemen-user.index', compact('operators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users',
            'nama_lengkap' => 'required|string',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'operator', // Paksa menjadi operator
            'is_aktif' => true,
        ]);

        return redirect()->back()->with('success', 'Operator berhasil ditambahkan.');
    }

    public function update(Request $request, $id) // Ubah 'User $user' menjadi '$id'
    {
        // Cari user secara manual agar pasti ketemu
        $user = User::findOrFail($id);

        // Pastikan yang diedit memang operator
        if ($user->role !== 'operator') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'name' => 'required|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required',
        ]);

        // Update data profil
        $user->update([
            'name' => $request->name,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'is_aktif' => $request->is_aktif,
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->back()->with('success', 'Data operator berhasil diperbarui.');
    }
    public function destroy($id) // Gunakan ID langsung untuk memastikan pencarian manual
    {
        $user = User::findOrFail($id);

        if ($user->role === 'operator') {
            $user->delete();
            return redirect()->back()->with('success', 'Operator berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Gagal menghapus: User bukan operator.');
    }
}
