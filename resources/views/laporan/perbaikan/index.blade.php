@extends('layout.master')

@section('title', 'Laporan Perbaikan ')

@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Laporan Perbaikan </h3>
            </div>

          
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    
                    <div class="x_content">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                        {{-- <form action="/admin/barang_/store" method="post">
                            @csrf --}}
                            <div class="form-group">
                                <label for="supplier_id">Tanggal Awal:</label>
                 
                                <input type="date" name="tanggal_awal" id="tanggal_awal"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="supplier_id">Tanggal Akhir:</label>
                 
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                            </div>
                        
                            <div class="col-12 d-flex justify-content-end">
                                {{-- <a href="#" onclick="exportToExcel()" class="btn btn-success me-1 mb-1">Ekspor ke Excel</a> --}}
                                <a href="" onclick="this.href='/cetak-laporan-perbaikan/'+ document.getElementById('tanggal_awal').value +
                                '/' + document.getElementById('tanggal_akhir').value " 
                                target="_blank" class="btn btn-primary me-1 mb-1">Cetak</a>
                            </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  
@endsection
