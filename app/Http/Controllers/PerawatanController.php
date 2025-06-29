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
        $perawatan = perawatan::with(['mesin', 'mekanik'])->get();
        return view('perawatan.index', compact('perawatan'));
    }

    public function create()
    {
        $mesins = Mesin::all();
        $mekaniks = User::where('role', 'Mekanik')->get();
    
        // Ambil kode_perawatan terakhir
        $last = Perawatan::orderBy('id', 'desc')->first();
        
        if ($last) {
            // Ambil angka terakhir dari format LPR-000001 → 1
            $number = (int) substr($last->kode_perawatan, 4);
            $newNumber = $number + 1;
        } else {
            $newNumber = 1;
        }
    
        // Format ulang: LPR-000001
        $kode_perawatan = 'LPR-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
    
        return view('perawatan.create', compact('mesins', 'mekaniks', 'kode_perawatan'));
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
                'mekanik_id' => 'required|exists:users,id',
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
        $mekaniks = User::where('role', 'Mekanik')->get();
        $perawatan = perawatan::findOrFail($id);

        return view('perawatan.edit', compact('mesins', 'mekaniks', 'perawatan'));
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
                'mekanik_id' => 'required|exists:users,id',
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
