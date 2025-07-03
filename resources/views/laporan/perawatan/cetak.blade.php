<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perawatan Mesin</title>
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
        <h1>Laporan Perawatan Mesin</h1>
    </header>

    <div class="print-button">
        <button onclick="window.print()">Print</button>
    </div>

    <main>
        <p>Periode: {{ $tanggal_mulai }} - {{ $tanggal_terakhir }}</p>
        <p>Total Perawatan: {{ $perawatans->count() }}</p>
        <p>Tanggal Cetak: {{ $tanggal_cetak }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Perawatan</th>
                    <th>Nama Mesin</th>
                    <th>Lokasi Mesin</th>
                    <th>Prioritas</th>
                    <th>Tanggal Pekerjaan</th>
                    <th>Keterangan</th>
                    <th>Mekanik</th>
                    <th>Status</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perawatans as $perawatan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $perawatan->kode_perawatan }}</td>
                        <td>{{ $perawatan->mesin?->nama_mesin ?? '-' }}</td>
                        <td>{{ $perawatan->mesin?->lokasi ?? '-' }}</td>
                        <td>{{ ucfirst($perawatan->prioritas) }}</td>
                        <td>{{ $perawatan->tanggal_pekerjaan ?? '-' }}</td>
                        <td class="wrap-text">{{ $perawatan->keterangan }}</td>
                        <td>{{ $perawatan->mekanik?->name ?? '-' }}</td>
                        <td>{{ ucfirst($perawatan->status) }}</td>
                        <td>{{ $perawatan->tanggal_selesai ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>
