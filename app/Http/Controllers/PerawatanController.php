<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use App\Models\perawatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerawatanController extends Controller
{
    public function index()
    {
        $perawatan = perawatan::with(['mesin', 'teknisi'])->get();
        return view('perawatan.index', compact('perawatan'));
    }

    public function create()
    {
        $mesins = Mesin::all();
        $teknisis = User::where('role', 'Mekanik')->get();// atau filter user role teknisi jika perlu
        return view('perawatan.create', compact('mesins', 'teknisis'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'mesin_id' => 'required|exists:mesins,id',
                'prioritas' => 'required|string',
                // 'tanggal_pekerjaan' => 'required|date',
                'keterangan' => 'required|string',
                'teknisi_id' => 'required|exists:users,id',
                // 'status' => 'required|string',
            ]);

            $status = "Dalam Pengerjaan";
            $prioritas = $request->input('prioritas');
            $tanggal_pekerjaan = Carbon::today();

            if ($prioritas === 'Critical') {
                $tanggal_pekerjaan->addDays(2);
            } elseif ($prioritas === 'Hight') {
                $tanggal_pekerjaan->addDays(14);
            } elseif ($prioritas === 'Medium') {
                $tanggal_pekerjaan->addDays(30);
            } elseif ($prioritas === 'Low') {
                $tanggal_pekerjaan->addDays(90);
            }

            $validatedData['tanggal_pekerjaan'] = $tanggal_pekerjaan;
            $validatedData['status'] = $status;

            perawatan::create($validatedData);

            return redirect('/perawatan')->with('status', 'Data perawatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }


    public function edit($id)
    {

        $mesins = Mesin::all();
        $teknisis = User::where('role', 'Mekanik')->get();
        $perawatan = perawatan::findOrFail($id);

        return view('perawatan.edit', compact('mesins', 'teknisis', 'perawatan'));
    }


    public function update(Request $request, $id)
    {
        try {
            $perawatan = Perawatan::findOrFail($id);

            // Validasi dasar
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'mesin_id' => 'required|exists:mesins,id',
                'prioritas' => 'required|string',
                'keterangan' => 'required|string',
                'teknisi_id' => 'required|exists:users,id',
                'status' => 'required|string|in:Menunggu,Selesai',
            ]);

            // Hitung tanggal_pekerjaan berdasarkan prioritas
            $prioritas = $validatedData['prioritas'];
            $tanggal_pekerjaan = Carbon::today();

            if ($prioritas === 'Critical') {
                $tanggal_pekerjaan->addDays(2);
            } elseif ($prioritas === 'Hight') {
                $tanggal_pekerjaan->addDays(14);
            } elseif ($prioritas === 'Medium') {
                $tanggal_pekerjaan->addDays(30);
            } elseif ($prioritas === 'Low') {
                $tanggal_pekerjaan->addDays(90);
            }

            $validatedData['tanggal_pekerjaan'] = $tanggal_pekerjaan;

            // Validasi tambahan jika status-nya 'Selesai'
            if ($validatedData['status'] === 'Selesai') {
                $request->validate([
                    'selesai_pada' => 'required|date',
                    'catatan_selesai' => 'required|string',
                ]);

                $validatedData['selesai_pada'] = $request->input('selesai_pada');
                $validatedData['catatan_selesai'] = $request->input('catatan_selesai');
            } else {
                $validatedData['selesai_pada'] = null;
                $validatedData['catatan_selesai'] = null;
            }

            $perawatan->update($validatedData);

            return redirect('/perawatan')->with('status', 'Data perawatan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }

        
    }


     public function delete($id)
    {
        perawatan::destroy($id);
        return back();
    }





}
