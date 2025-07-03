@extends('layout.master')

@section('title', 'Data Laporan Kerusakan')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="top_tiles">
            <h1>Data Laporan Kerusakan</h1>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h2>Tabel Data <small>Laporan Kerusakan</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Laporan</th>
                                            <th>Nomor WhatsApp</th>
                                            <th>Nama Mesin</th>
                                            <th>Isi Laporan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kerusakan as $item)
                                            @php
                                                switch ($item->status) {
                                                    case 'Diterima':
                                                        $rowClass = 'table-warning';
                                                        break;
                                                    case 'Diproses':
                                                        $rowClass = 'table-primary';
                                                        break;
                                                    case 'Selesai':
                                                        $rowClass = 'table-success';
                                                        break;
                                                    default:
                                                        $rowClass = '';
                                                }
                                            @endphp

                                            <tr class="{{ $rowClass }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kode_laporan }}</td>
                                                <td>{{ $item->nomor_whatsapp }}</td>
                                                <td>{{ $item->mesin->nama_mesin ?? '-' }}</td>
                                                <td>{{ $item->isi_laporan }}</td>
                                                <td><span class="badge badge-light">{{ $item->status }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
