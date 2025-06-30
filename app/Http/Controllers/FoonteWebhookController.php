<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKerusakan;
use App\Models\Mesin;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FoonteWebhookController extends Controller
{
    public function receive(Request $request)
    {
        // Validasi input WA webhook
        $request->validate([
            'number' => 'required',
            'message' => 'required'
        ]);

        $nomor = $request->input('number');
        $pesan = $request->input('message');

        // Log isi pesan masuk untuk debugging
        Log::info('Pesan masuk dari Fonnte', [
            'nomor' => $nomor,
            'pesan' => $pesan
        ]);

        // Tangani format: LAPOR#KODEMESIN#ISILAPORAN atau LAPOR#KODEMESIN#NAMAPELAPOR#ISILAPORAN
        if (Str::startsWith(strtoupper($pesan), 'LAPOR#')) {
            $parts = explode('#', $pesan);

            if (count($parts) >= 3) {
                $kodeMesin = trim($parts[1]);
                $namaPelapor = count($parts) === 4 ? trim($parts[2]) : 'Anonim';
                $isiLaporan = count($parts) === 4 ? trim($parts[3]) : trim($parts[2]);

                $mesin = Mesin::where('kode', $kodeMesin)->first();

                if ($mesin) {
                    $laporan = LaporanKerusakan::create([
                        'kode_laporan' => 'LRP-' . now()->format('YmdHis'),
                        'nomor_whatsapp' => $nomor,
                        'mesin_id' => $mesin->id,
                        'isi_laporan' => $isiLaporan,
                        'status' => 'Diterima',
                        // 'nama_pelapor' => $namaPelapor
                    ]);

                    $this->kirimBalasan($nomor, "✅ Laporan berhasil disimpan.\nKode: {$laporan->kode_laporan}\nTerima kasih, {$namaPelapor}.");
                } else {
                    $this->kirimBalasan($nomor, "❌ Kode mesin *{$kodeMesin}* tidak ditemukan.");
                }
            } else {
                $this->kirimBalasan($nomor, "❌ Format salah.\nGunakan:\nLAPOR#KODEMESIN#ISILAPORAN\natau\nLAPOR#KODEMESIN#NAMAPELAPOR#ISILAPORAN");
            }
        } else {
            // Format tidak sesuai
            $this->kirimBalasan($nomor, "👋 Halo! Untuk melapor, gunakan format:\nLAPOR#KODEMESIN#ISILAPORAN");
        }

        return response()->json(['status' => 'ok']);
    }

    private function kirimBalasan($nomor, $pesan)
    {
        // Kirim balasan ke WhatsApp menggunakan Fonnte
        Http::withHeaders([
            'Authorization' => env('FONNTE_API_KEY')
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $nomor,
            'message' => $pesan
        ]);
    }
}
