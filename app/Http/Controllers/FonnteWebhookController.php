<?php
// app/Http/Controllers/FonnteWebhookController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKerusakan;
use App\Models\Mesin;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FonnteWebhookController extends Controller
{
    // Tambahkan property untuk menyimpan nomor bot
    protected $botNumber;

    public function __construct()
    {
        // Ambil nomor bot dari .env atau konfigurasi lain
        // Pastikan nomor ini sudah terdaftar di Fonnte
        $this->botNumber = env('FONNTE_BOT_NUMBER'); // Tambahkan variabel ini di .env
    }

    public function receive(Request $request)
    {
        // Fonnte tidak selalu mengirimkan 'sender' di setiap payload
        // Beberapa payload, seperti pesan status, tidak memiliki 'sender'
        // Gunakan 'all()' untuk melihat seluruh payload
        $payload = $request->all();

        Log::info('Webhook Fonnte Diterima:', $payload);

        // --- Cek 1: Pastikan payload memiliki 'sender' dan 'message' ---
        if (!isset($payload['sender']) || !isset($payload['message'])) {
            // Ini bisa jadi webhook status, delivery report, atau attachment
            // Abaikan dan kembalikan response OK
            return response()->json(['status' => 'ignored']);
        }
        
        $nomor = $payload['sender'];
        $pesan = $payload['message'];
        
        // --- Cek 2: Cegah Looping ---
        // Abaikan pesan jika pengirimnya adalah nomor bot itu sendiri
        if ($nomor == $this->botNumber) {
            Log::info('Pesan dari nomor bot sendiri, diabaikan untuk mencegah looping.');
            return response()->json(['status' => 'ok']);
        }

        // --- Cek 3: Validasi Format Pesan ---
        // Jika format pesan tidak valid, Fonnte akan mengembalikan status 'error',
        // tetapi kita tetap perlu memastikan data ada sebelum diproses.
        $request->validate([
            'sender' => 'required',
            'message' => 'required'
        ]);

        Log::info('Pesan valid dari pengguna', [
            'nomor' => $nomor,
            'pesan' => $pesan
        ]);

        $pesan_upper = strtoupper($pesan);

        if (Str::startsWith($pesan_upper, 'LAPOR#')) {
            $parts = explode('#', $pesan);

            // Periksa jumlah bagian setelah di-explode
            // Format 1: LAPOR#KODEMESIN#ISILAPORAN (3 bagian)
            // Format 2: LAPOR#KODEMESIN#NAMAPELAPOR#ISILAPORAN (4 bagian)
            if (count($parts) >= 3) {
                $kodeMesin = trim($parts[1]);
                $isiLaporan = trim(end($parts)); // Mengambil bagian terakhir sebagai isi laporan
                $namaPelapor = 'Anonim';
                
                // Jika ada nama pelapor (4 bagian)
                if (count($parts) === 4) {
                    $namaPelapor = trim($parts[2]);
                    $isiLaporan = trim($parts[3]);
                } else {
                    $isiLaporan = trim($parts[2]);
                }

                $mesin = Mesin::where('kode_mesin', $kodeMesin)->first();

                if ($mesin) {
                    $laporan = LaporanKerusakan::create([
                        'kode_laporan' => 'LRP-' . now()->format('YmdHis'),
                        'nomor_whatsapp' => $nomor,
                        'mesin_id' => $mesin->id,
                        'isi_laporan' => $isiLaporan,
                        'status' => 'Diterima',
                    ]);

                    $this->kirimBalasan($nomor, "✅ Laporan berhasil disimpan.\nKode: {$laporan->kode_laporan}\nTerima kasih, {$namaPelapor}.");
                } else {
                    $this->kirimBalasan($nomor, "❌ Kode mesin {$kodeMesin} tidak ditemukan.");
                }
            } else {
                // Balasan untuk format yang kurang lengkap
                $this->kirimBalasan($nomor, "❌ Format salah.\nGunakan:\nLAPOR#KODEMESIN#ISILAPORAN\natau\nLAPOR#KODEMESIN#NAMAPELAPOR#ISILAPORAN");
            }
        } else {
            // Balasan default jika pesan tidak dimulai dengan 'LAPOR#'
            $this->kirimBalasan($nomor, "👋 Halo! Untuk melapor, gunakan format:\nLAPOR#KODEMESIN#ISILAPORAN");
        }

        // Fonnte mengharapkan response 200 OK
        return response()->json(['status' => 'ok']);
    }

    private function kirimBalasan($nomor, $pesan)
    {
        // Pastikan token sudah ada
        $token = env('FONNTE_API_KEY');
        if (!$token) {
            Log::error('FONNTE_API_KEY tidak ditemukan di .env');
            return; // Hentikan proses jika token tidak ada
        }

        // Pastikan nomor bot tidak mengirim balasan ke dirinya sendiri
        if ($nomor == $this->botNumber) {
            Log::warning('Percobaan mengirim balasan ke nomor bot sendiri. Dibatalkan.');
            return;
        }
        
        Log::info('Mengirim balasan ke nomor: ' . $nomor . ' dengan pesan: ' . $pesan);

        Http::withHeaders([
            'Authorization' => $token
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $nomor,
            'message' => $pesan
        ]);
    }
}