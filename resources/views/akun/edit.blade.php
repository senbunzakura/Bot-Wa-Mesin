@extends('layout.master')

@section('title', 'Edit Data Akun')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Akun</h3>
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
                            <form class="" action="/akun/update/{{ $akun->id }}" method="post" novalidate>
                                @csrf
                                @method('PATCH')
                                <span class="section">Edit Data Akun</span>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" value="{{ old('name', $akun->name) }}" name="name"
                                            required="required"
                                            class="form-control @error('name') parsley-error @enderror" />
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
                                        <input type="email" value="{{ old('email', $akun->email) }}" name="email" required="required"
                                            class="form-control @error('email') parsley-error @enderror" />
                                        @error('email')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Password</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="password" name="password"
                                            class="form-control @error('password') parsley-error @enderror" />
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
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
                                        <input type="text" value="{{ old('nomor_whatsapp', $akun->nomor_whatsapp) }}" name="nomor_whatsapp"
                                            class="form-control @error('nomor_whatsapp') parsley-error @enderror" />
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
                                        <select name="role" class="form-control" required="required">
                                            <option value="">Pilih Role</option>
                                            <option value="admin" {{ old('role', $akun->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            {{-- <option value="pelapor" {{ old('role', $akun->role) == 'pelapor' ? 'selected' : '' }}>Pelapor</option> --}}
                                            <option value="kepala_bagian" {{ old('role', $akun->role) == 'kepala_bagian' ? 'selected' : '' }}>Kepala Bagian</option>
                                            <option value="mekanik" {{ old('role', $akun->role) == 'mekanik' ? 'selected' : '' }}>Mekanik</option>
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
                                            <button type='submit' class="btn btn-primary">Update</button>
                                            <a href="/akun" class="btn btn-danger">Batal</a>
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
