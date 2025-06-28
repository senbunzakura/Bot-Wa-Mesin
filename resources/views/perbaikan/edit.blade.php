@extends('layout.master')

@section('title', 'Edit Data Perbaikan')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Perbaikan Mesin</h3>
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

                            <form action="/perbaikan/update/{{ $perbaikan->id }}" method="post" novalidate>
                                @csrf
                                @method('PUT')
                                <span class="section">Edit Data Perbaikan</span>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Laporan Kerusakan <span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <select name="laporan_perbaikan_id" class="form-control" required>
                                            <option value="">Pilih Laporan</option>
                                            @foreach ($laporans as $laporan)
                                                <option value="{{ $laporan->id }}" {{ $perbaikan->laporan_perbaikan_id == $laporan->id ? 'selected' : '' }}>
                                                    {{ $laporan->judul }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('laporan_perbaikan_id')
                                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Prioritas <span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <select name="prioritas" class="form-control" required>
                                            <option value="">Pilih Prioritas</option>
                                            <option value="Critical" {{ $perbaikan->prioritas == 'Critical' ? 'selected' : '' }}>Critical</option>
                                            <option value="Hight" {{ $perbaikan->prioritas == 'Hight' ? 'selected' : '' }}>Hight</option>
                                            <option value="Medium" {{ $perbaikan->prioritas == 'Medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="Low" {{ $perbaikan->prioritas == 'Low' ? 'selected' : '' }}>Low</option>
                                        </select>
                                        @error('prioritas')
                                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Keterangan <span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <textarea name="keterangan" class="form-control" required>{{ $perbaikan->keterangan }}</textarea>
                                        @error('keterangan')
                                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Lokasi <span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="lokasi" value="{{ $perbaikan->lokasi }}" class="form-control" required>
                                        @error('lokasi')
                                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Teknisi <span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <select name="teknisi_id" class="form-control" required>
                                            <option value="">Pilih Teknisi</option>
                                            @foreach ($teknisis as $teknisi)
                                                <option value="{{ $teknisi->id }}" {{ $perbaikan->teknisi_id == $teknisi->id ? 'selected' : '' }}>
                                                    {{ $teknisi->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('teknisi_id')
                                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Catatan Selesai</label>
                                    <div class="col-md-6">
                                        <textarea name="catatan_selesai" class="form-control">{{ $perbaikan->catatan_selesai }}</textarea>
                                        @error('catatan_selesai')
                                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Tanggal Selesai</label>
                                    <div class="col-md-6">
                                        <input type="date" name="tanggal_selesai" value="{{ $perbaikan->tanggal_selesai }}" class="form-control">
                                        @error('tanggal_selesai')
                                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="/perbaikan" class="btn btn-danger">Batal</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
