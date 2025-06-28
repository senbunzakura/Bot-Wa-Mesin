@extends('layout.master')

@section('title', 'Data Perbaikan')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="top_tiles">
                <h1>Data Perbaikan Mesin</h1>
            </div>

            <div class="col-md-12 col-sm-12 ">
                <a href="/perbaikan/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
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

                        <h2>Tabel Data <small>Perbaikan</small></h2>
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
                                                <th>Judul</th>
                                                <th>Mesin</th>
                                                <th>Prioritas</th>
                                                <th>Tanggal Pekerjaan</th>
                                                <th>Teknisi</th>
                                                <th>Status</th>
                                                <th>Selesai Pada</th>
                                                <th style="width: 20%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($perbaikan as $p)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $p->judul }}</td>
                                                    <td>{{ $p->mesin->machine_name ?? '-' }}</td>
                                                    <td>{{ $p->prioritas }}</td>
                                                    <td>{{ $p->tanggal_pekerjaan }}</td>
                                                    <td>{{ $p->teknisi->username ?? '-' }}</td>
                                                    <td>{{ $p->status }}</td>
                                                    <td>{{ $p->tanggal_selesai ?? '-' }}</td>
                                                    <td style="text-align: left">
                                                        <a href="/perbaikan/edit/{{ $p->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                                        <form action="/perbaikan/delete/{{ $p->id }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </button>
                                                        </form>
                                                    </td>
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
@endsection
