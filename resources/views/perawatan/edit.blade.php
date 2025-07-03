@extends('layout.master')

@section('title', 'Edit Data Perawatan')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Perawatan Mesin</h3>
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

                            <form action="{{ route('perawatan.update', $perawatan->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <span class="section">Edit Data Perawatan</span>

                                <!-- Kode Perawatan -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Kode Perawatan <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        @if (Auth::guard('user')->user()->role == 'kepala_bagian')
                                            <input type="text" name="kode_perawatan" class="form-control"
                                                value="{{ old('kode_perawatan', $perawatan->kode_perawatan) }}" readonly
                                                required>
                                        @endif
                                        @if (Auth::guard('user')->user()->role == 'mekanik')
                                            <input type="text" name="kode_perawatan" class="form-control"
                                                value="{{ old('kode_perawatan', $perawatan->kode_perawatan) }}" readonly
                                                required>
                                        @endif
                                    </div>
                                </div>

                                <!-- Mesin -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Mesin <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        @if (Auth::guard('user')->user()->role == 'kepala_bagian')
                                            <select name="mesin_id" class="form-control" required>
                                                @foreach ($mesins as $m)
                                                    <option value="{{ $m->id }}"
                                                        {{ $perawatan->mesin_id == $m->id ? 'selected' : '' }}>
                                                        {{ $m->kode_mesin }} || {{ $m->nama_mesin }} || {{ $m->status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (Auth::guard('user')->user()->role == 'mekanik')
                                            <input readonly type="text" name="mesin_ids" id="mesin_ids"
                                                value="{{ $perawatan->mesin->nama_mesin }}" class="form-control">
                                            <input readonly type="hidden" name="mesin_id" id="mesin_id"
                                                value="{{ $perawatan->mesin_id }}" class="form-control">
                                        @endif
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Keterangan <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        @if (Auth::guard('user')->user()->role == 'kepala_bagian')
                                            <textarea name="keterangan" class="form-control" required>{{ old('keterangan', $perawatan->keterangan) }}</textarea>
                                        @endif
                                        @if (Auth::guard('user')->user()->role == 'mekanik')
                                            <textarea name="keterangan" class="form-control" readonly>{{ old('keterangan', $perawatan->keterangan) }}</textarea>
                                        @endif
                                    </div>
                                </div>

                                <!-- Prioritas -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Prioritas <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        @if (Auth::guard('user')->user()->role == 'kepala_bagian')
                                            <select name="prioritas" id="prioritas" class="form-control" required>
                                                @foreach (['Low', 'Medium', 'High', 'Critical'] as $priority)
                                                    <option value="{{ $priority }}"
                                                        {{ $perawatan->prioritas == $priority ? 'selected' : '' }}>
                                                        {{ $priority }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (Auth::guard('user')->user()->role == 'mekanik')
                                            <input type="text" name="prioritas" class="form-control"
                                                value="{{ old('prioritas', $perawatan->prioritas) }}" readonly required>
                                        @endif
                                        @error('prioritas')
                                            <ul class="parsley-errors-list filled">
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tanggal Batas Pekerjaan -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Tanggal Batas Pekerjaan</label>
                                    <div class="col-md-6">
                                        <input readonly type="date" name="tanggal_pekerjaan" id="tanggal_pekerjaan"
                                            value="{{ $perawatan->tanggal_pekerjaan }}" class="form-control">
                                        @error('tanggal_pekerjaan')
                                            <ul class="parsley-errors-list filled">
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Mekanik -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Mekanik <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        @if (Auth::guard('user')->user()->role == 'kepala_bagian')
                                            <select name="mekanik_id" class="form-control" required>
                                                @foreach ($mekaniks as $mekanik)
                                                    <option value="{{ $mekanik->id }}"
                                                        {{ $perawatan->mekanik_id == $mekanik->id ? 'selected' : '' }}>
                                                        {{ $mekanik->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (Auth::guard('user')->user()->role == 'mekanik')
                                            <input type="text" name="mekanik_ids" class="form-control"
                                                value="{{ old('mekanik_ids', $perawatan->mekanik->name) }}" readonly
                                                required>
                                            <input type="hidden" name="mekanik_id" class="form-control"
                                                value="{{ old('mekanik_id', $perawatan->mekanik_id) }}" readonly
                                                required>
                                        @endif

                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Status</label>
                                    <div class="col-md-6">
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="Dalam Pengerjaan"
                                                {{ $perawatan->status == 'Dalam Pengerjaan' ? 'selected' : '' }}>Dalam
                                                Pengerjaan</option>
                                            <option value="Selesai"
                                                {{ $perawatan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="Tertunda"
                                                {{ $perawatan->status == 'Tertunda' ? 'selected' : '' }}>
                                                Tertunda</option>

                                        </select>
                                        @error('status')
                                            <ul class="parsley-errors-list filled">
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Catatan dan Tanggal Selesai -->
                                <div id="selesai_fields" style="display: none;">
                                    <!-- Catatan Selesai -->
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 label-align">Catatan Selesai</label>
                                        <div class="col-md-6">
                                            <textarea name="catatan_selesai" class="form-control">{{ $perawatan->catatan_selesai }}</textarea>
                                            @error('catatan_selesai')
                                                <ul class="parsley-errors-list filled">
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tanggal Selesai -->
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 label-align">Tanggal Selesai</label>
                                        <div class="col-md-6">
                                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                                value="{{ $perawatan->tanggal_selesai }}" class="form-control">
                                            @error('tanggal_selesai')
                                                <ul class="parsley-errors-list filled">
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Foto -->
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 label-align">Foto</label>
                                    <div class="col-md-6">
                                        <input type="file" name="foto" class="form-control">
                                        @if ($perawatan->foto)
                                            <img src="{{ asset($perawatan->foto) }}" alt="Foto Perbaikan" class="mt-2"
                                                style="max-height: 150px;">
                                        @endif
                                        @error('foto')
                                            <ul class="parsley-errors-list filled">
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" class="btn btn-success">Update</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const prioritasSelect = document.getElementById('prioritas');
            const tanggalInput = document.getElementById('tanggal_pekerjaan');
            const statusSelect = document.getElementById('status');
            const selesaiFields = document.getElementById('selesai_fields');
            const tanggalSelesaiInput = document.getElementById('tanggal_selesai');

            function toggleSelesaiFields() {
                if (statusSelect.value === 'Selesai') {
                    selesaiFields.style.display = 'block';
                    if (!tanggalSelesaiInput.value) {
                        const today = new Date().toISOString().split('T')[0];
                        tanggalSelesaiInput.value = today;
                    }
                } else {
                    selesaiFields.style.display = 'none';
                    tanggalSelesaiInput.value = '';
                }
            }

            statusSelect.addEventListener('change', toggleSelesaiFields);
            toggleSelesaiFields();


            const updateTanggal = () => {
                const today = new Date();
                let daysToAdd = 0;

                switch (prioritasSelect.value) {
                    case 'Critical':
                        daysToAdd = 2;
                        break;
                    case 'High':
                        daysToAdd = 14;
                        break;
                    case 'Medium':
                        daysToAdd = 30;
                        break;
                    case 'Low':
                        daysToAdd = 90;
                        break;
                }

                // Hitung tanggal
                today.setDate(today.getDate() + daysToAdd);

                // Format YYYY-MM-DD
                const formattedDate = today.toISOString().split('T')[0];
                tanggalInput.value = formattedDate;
            };

            // Jalankan saat prioritas berubah
            prioritasSelect.addEventListener('change', updateTanggal);
        });
    </script>
@endsection
