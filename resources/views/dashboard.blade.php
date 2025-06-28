@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="right_col" role="main">
        <div class="col-lg-12">
            <div class="top_tiles">
                <h1 class="text-center mb-4">Selamat Datang Di <strong>SIPEDAU</strong></h1>
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #007bff; border-radius: 10px;">
                            <div>
                                <h5>Total Mesin</h5>
                                {{-- <h3 class="text-white">{{ $pengecekanTotal }}</h3> --}}
                            </div>
                            <i class="fa fa-truck fa-2x"></i>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #28a745; border-radius: 10px;">
                            <div>
                                <h5>Total Perawatan</h5>
                                {{-- <h3 class="text-white">{{ $laporanDiterimaCounts['Selesai'] ?? 0 }}</h3> --}}
                            </div>
                            <i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #ffc107; border-radius: 10px;">
                            <div>
                                <h5>Total Perbaikan</h5>
                                {{-- <h3 class="text-white">{{ $laporanDiprosesCounts['Menunggu'] ?? 0 }}</h3> --}}
                            </div>
                            <i class="fa fa-hourglass-half fa-2x"></i>
                        </div>
                    </div>
                    
          

                </div>
            </div>
        </div>

    </div>
@endsection
