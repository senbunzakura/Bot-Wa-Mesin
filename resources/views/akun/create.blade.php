@extends('layout.master')

@section('title', 'Input Data Akun')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Akun</h3>
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
                            <form action="{{ route('akun.store') }}" method="POST" novalidate>
                                @csrf
                                <span class="section">Input Data Akun</span>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name') parsley-error @enderror" required>
                                        @error('name')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email') parsley-error @enderror" required>
                                        @error('email')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="password" name="password"
                                            class="form-control @error('password') parsley-error @enderror" required>
                                        @error('password')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nomor Whatsapp</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" name="nomor_whatsapp" value="{{ old('nomor_whatsapp') }}"
                                            class="form-control @error('nomor_whatsapp') parsley-error @enderror">
                                        @error('nomor_whatsapp')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Role<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="role" class="form-control" required>
                                            <option value="">Pilih Role</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            {{-- <option value="pelapor" {{ old('role') == 'pelapor' ? 'selected' : '' }}>Pelapor</option> --}}
                                            <option value="kepala_bagian" {{ old('role') == 'kepala_bagian' ? 'selected' : '' }}>Kepala Bagian</option>
                                            <option value="mekanik" {{ old('role') == 'mekanik' ? 'selected' : '' }}>Mekanik</option>
                                        </select>
                                        @error('role')
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
                                            <a href="{{ route('akun.index') }}" class="btn btn-danger">Batal</a>
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
