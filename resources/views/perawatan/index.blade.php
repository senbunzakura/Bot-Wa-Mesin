@extends('layout.master')

@section('title', 'Data Perawatan')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="top_tiles">
                <h1>Data Perawatan Mesin</h1>
            </div>

            <div class="col-md-12 col-sm-12">
                @if (Auth::guard('user')->user()->role == 'kepala_bagian')
                    <a href="{{ url('/perawatan/create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i>
                        Tambah
                        Data</a>
                @endif
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

                        <h2>Tabel Data <small>Perawatan</small></h2>
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
                                                <th>Kode Perawatan</th>
                                                <th>Nama Mesin</th>
                                                <th>Prioritas</th>
                                                <th>Tanggal Pekerjaan</th>
                                                <th>Mekanik</th>
                                                <th>Status</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Catatan Selesai</th>
                                                {{-- <th>Foto</th> --}}
                                                <th style="width: 15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($perawatan as $p)
                                                @php
                                                    switch ($p->status) {
                                                        case 'Dalam Pengerjaan':
                                                            $rowClass = 'table-warning';
                                                            break;
                                                        case 'Tertunda':
                                                            $rowClass = 'table-danger';
                                                            break;
                                                        case 'Selesai':
                                                            $rowClass = 'table-success';
                                                            break;
                                                        default:
                                                            $rowClass = '';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $p->kode_perawatan }}</td>
                                                    <td>{{ $p->mesin->nama_mesin ?? '-' }}</td>
                                                    <td>{{ $p->prioritas }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_pekerjaan)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $p->mekanik->name ?? '-' }}</td>
                                                    <td>{{ ucfirst($p->status) }}</td>
                                                    <td>{{ $p->tanggal_selesai ? \Carbon\Carbon::parse($p->tanggal_selesai)->format('d-m-Y') : '-' }}
                                                    </td>
                                                    <td>{{ $p->catatan_selesai ?? '-' }}</td>

                                                    <td>
                                                        <a href="{{ url('/perawatan/edit/' . $p->id) }}"
                                                            class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                                        @if (Auth::guard('user')->user()->role == 'kepala_bagian')
                                                            <form action="{{ url('/perawatan/delete/' . $p->id) }}"
                                                                method="POST" class="d-inline"
                                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs"><i
                                                                        class="fa fa-trash-o"></i></button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.card-box -->
                            </div>
                        </div>
                    </div><!-- /.x_content -->
                </div><!-- /.x_panel -->
            </div>
        </div>
    </div>
@endsection
