<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kerusakan Mesin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        @page { size: A4 portrait; margin: 0; }
        body { margin: 1cm; font-family: Arial, sans-serif; }
        h1 { text-align: center; margin-bottom: 20px; }
        .logo { height: 80px; width: auto; display: block; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        .wrap-text { word-wrap: break-word; white-space: normal; }
        .page-break { page-break-after: always; }
        .print-button { display: block; width: 100%; text-align: right; margin-bottom: 20px; }
        .print-button button { padding: 10px 20px; font-size: 16px; cursor: pointer; }
        @media print { .print-button { display: none; } }
    </style>
</head>
<body>

    <header>
        {{-- <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo Perusahaan" class="logo"> --}}
        <h1>Laporan Kerusakan Mesin</h1>
    </header>

    <div class="print-button">
        <button onclick="window.print()">Print</button>
    </div>

    <main>
        <p>Periode: {{ $tanggal_mulai }} - {{ $tanggal_terakhir }}</p>
        <p>Total Laporan: {{ $perbaikan->count() }}</p>
        <p>Tanggal Cetak: {{ $tanggal_cetak }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Laporan</th>
                    <th>Nomor WhatsApp</th>
                    <th>Nama Mesin</th>
                    <th>Isi Laporan</th>
                    <th>Status Laporan</th>
                    <th>Prioritas</th>
                    <th>Lokasi</th>
                    <th>Tanggal Pekerjaan</th>
                    <th>Mekanik</th>
                    <th>Status Perbaikan</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perbaikan as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $laporan->laporanKerusakan->kode_laporan }}</td>
                        <td>{{ $laporan->laporanKerusakan->nomor_whatsapp }}</td>
                        <td>{{ $laporan->laporanKerusakan->mesin?->nama_mesin ?? '-' }}</td>
                        <td class="wrap-text">{{ $laporan->laporanKerusakan->isi_laporan }}</td>
                        <td>{{ $laporan->status }}</td>
                        <td>{{ $laporan->prioritas ?? '-' }}</td>
                        <td>{{ $laporan->lokasi ?? '-' }}</td>
                        <td>{{ $laporan->tanggal_pekerjaan ?? '-' }}</td>
                        <td>{{ $laporan->mekanik?->name ?? '-' }}</td>
                        <td>{{ $laporan->status ?? '-' }}</td>
                        <td>{{ $laporan->tanggal_selesai ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>
