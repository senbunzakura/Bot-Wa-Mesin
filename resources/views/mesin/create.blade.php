@extends('layout.master')

@section('title', 'Input Data Mesin')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Mesin</h3>
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

                            <form action="/mesin/store" method="post" novalidate>
                                @csrf
                                <span class="section">Input Data Mesin</span>

                                {{-- Kode Mesin (otomatis) --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Kode Mesin</label>
                                    <div class="col-md-6">
                                        <input type="text" name="kode_mesin" value="{{ $kodeMesin }}" class="form-control" readonly>
                                    </div>
                                </div>

                                {{-- Nama Mesin --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Nama Mesin<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" name="nama_mesin" value="{{ old('nama_mesin') }}"
                                            class="form-control @error('nama_mesin') parsley-error @enderror" required>
                                        @error('nama_mesin')
                                            <ul class="parsley-errors-list filled">
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Lokasi --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Lokasi</label>
                                    <div class="col-md-6">
                                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control">
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Status</label>
                                    <div class="col-md-6">
                                        <select name="status" class="form-control">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="Under Maintenance" {{ old('status') == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                            <option value="Retired" {{ old('status') == 'Retired' ? 'selected' : '' }}>Retired</option>
                                        </select>
                                        @error('status')
                                            <ul class="parsley-errors-list filled">
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="/mesin" class="btn btn-danger">Batal</a>
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
