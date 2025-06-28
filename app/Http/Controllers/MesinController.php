<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MesinController extends Controller
{
    public function index()
    {
        $mesin = Mesin::all();
        return view('mesin.index', compact('mesin'));
    }

    public function create()
    {
        $kodeMesin = Mesin::generateKodeMesin(); // fungsi auto kode di model
        return view('mesin.create', compact('kodeMesin'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                // 'kode_mesin' => 'required|string|max:255|unique:mesins,kode_mesin',
                'nama_mesin' => 'required|string|max:255',
                'lokasi' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:255',
            ]);

            // Generate kode otomatis
            $validatedData['kode_mesin'] = Mesin::generateKodeMesin();
            Mesin::create($validatedData);

            return redirect('/mesin')->with('status', 'Data mesin berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $mesin = Mesin::findOrFail($id);
        return view('mesin.edit', compact('mesin'));
    }

    public function update(Request $request, $id)
    {
        try {
            $mesin = Mesin::findOrFail($id);

            $validatedData = $request->validate([
                'kode_mesin' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('mesins', 'kode_mesin')->ignore($mesin->id),
                ],
                'nama_mesin' => 'required|string|max:255',
                'lokasi' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:255',
            ]);

            $mesin->update($validatedData);

            return redirect('/mesin')->with('status', 'Data mesin berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function delete($id)
    {
        try {
            Mesin::destroy($id);
            return redirect('/mesin')->with('status', 'Data mesin berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
