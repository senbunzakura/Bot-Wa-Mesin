<?php

namespace App\Http\Controllers;

use App\Models\Perbaikan;
use App\Models\LaporanKerusakan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikan = Perbaikan::with('laporanKerusakan', 'mekanik')->get();

        return view('perbaikan.index', compact('perbaikan'));
    }

    public function create()
    {
        $laporans = LaporanKerusakan::with('mesin')->where('status', 'Diterima')->get();
        $mekaniks = User::where('role', 'mekanik')->get();

        return view('perbaikan.create', compact('laporans', 'mekaniks'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'laporan_perbaikan_id' => 'required|exists:laporan_kerusakans,id',
                'keterangan' => 'required|string',
                'prioritas' => 'required|string|in:Critical,High,Medium,Low',
                'lokasi' => 'required|string',
                'mekanik_id' => 'required|exists:users,id',
            ]);

            $tanggal_pekerjaan = Carbon::today();

            switch ($validatedData['prioritas']) {
                case 'Critical':
                    $tanggal_pekerjaan->addDays(2);
                    break;
                case 'High':
                    $tanggal_pekerjaan->addDays(14);
                    break;
                case 'Medium':
                    $tanggal_pekerjaan->addDays(30);
                    break;
                case 'Low':
                    $tanggal_pekerjaan->addDays(90);
                    break;
            }

            $validatedData['tanggal_pekerjaan'] = $tanggal_pekerjaan;
            $validatedData['status'] = 'Dijadwalkan'; // set default status

            // Simpan Perbaikan
            Perbaikan::create($validatedData);

            // Update status laporan jika masih "Diterima"
            $laporan = LaporanKerusakan::find($validatedData['laporan_perbaikan_id']);
            if ($laporan && $laporan->status === 'Diterima') {
                $laporan->status = 'Diproses';
                $laporan->save();
            }

            return redirect('/perbaikan')->with('status', 'Data perbaikan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $perbaikan = Perbaikan::with(['laporanKerusakan', 'mekanik'])->findOrFail($id);
        $laporans = LaporanKerusakan::with('mesin' )->get();
        $mekaniks = User::where('role', 'mekanik')->get();

        return view('perbaikan.edit', compact('perbaikan', 'laporans', 'mekaniks'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'laporan_perbaikan_id' => 'required|exists:laporan_kerusakans,id',
                'keterangan' => 'required|string',
                'prioritas' => 'required|string|in:Critical,High,Medium,Low',
                'lokasi' => 'required|string',
                'mekanik_id' => 'required|exists:users,id',
                'catatan_selesai' => 'nullable|string',
                'tanggal_selesai' => 'nullable|date',
                'status' => 'required|string|in:Dijadwalkan,Dalam Proses,Tertunda,Selesai',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Hitung ulang tanggal pekerjaan berdasarkan prioritas
            $tanggal_pekerjaan = Carbon::today();

            switch ($validatedData['prioritas']) {
                case 'Critical':
                    $tanggal_pekerjaan->addDays(2);
                    break;
                case 'High':
                    $tanggal_pekerjaan->addDays(14);
                    break;
                case 'Medium':
                    $tanggal_pekerjaan->addDays(30);
                    break;
                case 'Low':
                    $tanggal_pekerjaan->addDays(90);
                    break;
            }

            $validatedData['tanggal_pekerjaan'] = $tanggal_pekerjaan;

            // Handle foto jika ada
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $namaFile = time() . '_' . $foto->getClientOriginalName();
                $foto->move(public_path('uploads/foto_perbaikan'), $namaFile);
                $validatedData['foto'] = 'uploads/foto_perbaikan/' . $namaFile;
            }

            // Update Perbaikan
            $perbaikan = Perbaikan::findOrFail($id);
            $perbaikan->update($validatedData);

            // Update status pada LaporanKerusakan jika perlu
            $laporan = $perbaikan->laporanKerusakan;
            if ($validatedData['status'] === 'Selesai') {
                $laporan->status = 'Selesai';
            } elseif ($validatedData['status'] === 'Tertunda') {
                $laporan->status = 'Tertunda';
            }
            $laporan->save();

            return redirect('/perbaikan')->with('status', 'Data perbaikan berhasil diupdate.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }



    public function destroy($id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->delete();

        return redirect('/perbaikan')->with('status', 'Data perbaikan berhasil dihapus.');
    }
}
