<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FonnteWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Cek apakah ini adalah webhook yang berisi pesan masuk
        // Kita bisa mengeceknya dengan melihat apakah ada key 'message'
        if ($request->has('message')) {

            // ---- LETAKKAN SEMUA KODE LOGIKA BOT ANDA DI DALAM SINI ----

            Log::info('Webhook Pesan Diterima:');

            // Contoh: Mengambil data pesan
            $sender = $request->input('sender');
            $message = $request->input('message');
            $name = $request->input('name');

            // Lakukan sesuatu dengan pesan ini, misalnya membalasnya
            // ...

            // Kirim respons sukses
            return response()->json(['status' => 'success', 'message' => 'Message processed']);

        } else {
            // Jika ini bukan webhook pesan (misalnya notifikasi status 'disconnect')
            // kita abaikan saja dan kirim respons sukses agar Fonnte berhenti mengirim ulang.
            Log::info('Webhook Non-Pesan Diterima (diabaikan): ' . json_encode($request->all()));

            return response()->json(['status' => 'success', 'message' => 'Non-message event ignored']);
        }
    }
}