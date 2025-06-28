@extends('layout.master')

@section('title', 'Edit Data Perawatan')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Data Perawatan Mesin</h3>
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

                            <form action="/perawatan/update/{{ $perawatan->id }}" method="POST" novalidate>
                                @csrf
                                @method('PATCH')
                                <span class="section">Edit Data Perawatan</span>

                                {{-- Judul --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Judul <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" name="judul" value="{{ old('judul', $perawatan->judul) }}"
                                            class="form-control @error('judul') parsley-error @enderror" required>
                                        @error('judul')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Mesin --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Mesin <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="mesin_id" class="form-control" required>
                                            <option value="">Pilih Mesin</option>
                                            @foreach ($mesins as $mesin)
                                                <option value="{{ $mesin->id }}"
                                                    {{ old('mesin_id', $perawatan->mesin_id) == $mesin->id ? 'selected' : '' }}>
                                                    {{ $mesin->machine_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('mesin_id')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Prioritas --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Prioritas <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="prioritas" class="form-control" required>
                                            <option value="">Pilih Prioritas</option>
                                            @foreach (['Critical', 'Hight', 'Medium', 'Low'] as $prioritas)
                                                <option value="{{ $prioritas }}"
                                                    {{ old('prioritas', $perawatan->prioritas) == $prioritas ? 'selected' : '' }}>
                                                    {{ $prioritas }}</option>
                                            @endforeach
                                        </select>
                                        @error('prioritas')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Tanggal Pekerjaan --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pekerjaan <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="date" name="tanggal_pekerjaan"
                                            value="{{ old('tanggal_pekerjaan', $perawatan->tanggal_pekerjaan) }}"
                                            class="form-control @error('tanggal_pekerjaan') parsley-error @enderror"
                                            required>
                                        @error('tanggal_pekerjaan')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Keterangan --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <textarea name="keterangan" class="form-control @error('keterangan') parsley-error @enderror" required>{{ old('keterangan', $perawatan->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Teknisi --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Teknisi <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="teknisi_id" class="form-control" required>
                                            <option value="">Pilih Teknisi</option>
                                            @foreach ($teknisis as $teknisi)
                                                <option value="{{ $teknisi->id }}"
                                                    {{ old('teknisi_id', $perawatan->teknisi_id) == $teknisi->id ? 'selected' : '' }}>
                                                    {{ $teknisi->username }}</option>
                                            @endforeach
                                        </select>
                                        @error('teknisi_id')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Status <span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="status" class="form-control" id="statusSelect" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Dalam Pengerjaan"
                                                {{ old('status', $perawatan->status) == 'Dalam Pengerjaan' ? 'selected' : '' }}>
                                                Dalam Pengerjaan</option>
                                            <option value="Selesai"
                                                {{ old('status', $perawatan->status) == 'Selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                        </select>
                                        @error('status')
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Bagian tambahan yang muncul jika status == Selesai --}}
                                <div id="selesaiSection">
                                    {{-- Tanggal Selesai --}}
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Selesai <span
                                                class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="date" name="selesai_pada"
                                                value="{{ old('selesai_pada', $perawatan->selesai_pada) }}"
                                                class="form-control @error('selesai_pada') parsley-error @enderror">
                                            @error('selesai_pada')
                                                <ul class="parsley-errors-list filled">
                                                    <li class="parsley-required">{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Catatan Selesai --}}
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Catatan Selesai <span
                                                class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <textarea name="catatan_selesai" class="form-control @error('catatan_selesai') parsley-error @enderror">{{ old('catatan_selesai', $perawatan->catatan_selesai) }}</textarea>
                                            @error('catatan_selesai')
                                                <ul class="parsley-errors-list filled">
                                                    <li class="parsley-required">{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
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

    <script>
        function toggleSelesaiSection() {
            const status = document.getElementById('statusSelect').value;
            const selesaiSection = document.getElementById('selesaiSection');
            selesaiSection.style.display = (status === 'Selesai') ? 'block' : 'none';
        }

        document.getElementById('statusSelect').addEventListener('change', toggleSelesaiSection);
        window.addEventListener('DOMContentLoaded', toggleSelesaiSection);
    </script>
@endsection
