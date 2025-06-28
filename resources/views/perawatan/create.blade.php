@extends('layout.master')

@section('title', 'Input Data Perawatan')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Perawatan Mesin</h3>
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

                            <form action="/perawatan/store" method="post" novalidate>
                                @csrf
                                <span class="section">Input Data Perawatan</span>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Judul <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" name="judul" value="{{ old('judul') }}" required="required" class="form-control @error('judul') parsley-error @enderror" />
                                        @error('judul')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Mesin <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="mesin_id" class="form-control" required="required">
                                            <option value="">Pilih Mesin</option>
                                            @foreach ($mesins as $mesin)
                                                <option value="{{ $mesin->id }}" {{ old('mesin_id') == $mesin->id ? 'selected' : '' }}>
                                                    {{ $mesin->machine_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mesin_id')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Prioritas <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="prioritas" class="form-control" required="required">
                                            <option value="">Pilih Prioritas</option>
                                          <option value="Critical" {{ old('status') == 'Critical' ? 'selected' : '' }}>Critical</option>
                                            <option value="Hight" {{ old('status') == 'Hight' ? 'selected' : '' }}>Hight</option>
                                            <option value="Medium" {{ old('status') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="Low" {{ old('status') == 'Low' ? 'selected' : '' }}>Low</option>
                                        </select>
                                        @error('prioritas')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pekerjaan <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="date" name="tanggal_pekerjaan" value="{{ old('tanggal_pekerjaan') }}" required="required" class="form-control @error('tanggal_pekerjaan') parsley-error @enderror" />
                                        @error('tanggal_pekerjaan')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <textarea name="keterangan" class="form-control @error('keterangan') parsley-error @enderror" required>{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Teknisi <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="teknisi_id" class="form-control" required="required">
                                            <option value="">Pilih Teknisi</option>
                                            @foreach ($teknisis as $teknisi)
                                                <option value="{{ $teknisi->id }}" {{ old('teknisi_id') == $teknisi->id ? 'selected' : '' }}>
                                                    {{ $teknisi->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('teknisi_id')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="/perawatan" class="btn btn-danger">Batal</a>
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
