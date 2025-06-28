@extends('layout.master')

@section('title', 'Data Mesin')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="top_tiles">
                <h1>Data Mesin</h1>
            </div>

            <div class="col-md-12 col-sm-12 ">
                <a href="/mesin/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
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

                        <h2>Tabel Data <small>Mesin</small></h2>
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
                                                <th>Kode Mesin</th>
                                                <th>Nama Mesin</th>
                                                <th>Lokasi</th>
                                                <th>Status</th>
                                                <th style="width: 20%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($mesin as $e)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $e->kode_mesin }}</td>
                                                    <td>{{ $e->nama_mesin }}</td>
                                                    <td>{{ $e->lokasi }}</td>
                                                    <td>{{ $e->status }}</td>
                                                    <td style="text-align: left">
                                                        <a href="/mesin/edit/{{ $e->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                                        <form action="/mesin/delete/{{ $e->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data?')">
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
