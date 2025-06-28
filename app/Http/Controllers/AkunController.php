<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AkunController extends Controller
{
    public function index()
    {
        $akun = User::all();
        return view('akun.index', compact('akun'));
    }

    public function create()
    {
        return view('akun.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'role' => 'required|in:pelapor,kepala_bagian,admin,mekanik',
                'nomor_whatsapp' => 'nullable|string|max:20',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);

            return redirect('/akun')->with('status', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                         ->withInput();
        }
    }

    public function edit($id)
    {
        $akun = User::findOrFail($id);
        return view('akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        
        $akun = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($akun->id)],
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:pelapor,kepala_bagian,admin,mekanik',
            'nomor_whatsapp' => 'nullable|string|max:20',
        ]);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $akun->update($validatedData);

        return redirect('/akun')->with('status', 'Data berhasil diedit.');
        
    }

    public function delete($id)
    {
        User::destroy($id);
        return back()->with('status', 'Data berhasil dihapus.');
    }
}
