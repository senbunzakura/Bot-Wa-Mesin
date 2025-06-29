@extends('layout.master')

@section('title', 'Input Data Perawatan')

@section('content')
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
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Kode Perawatan <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" 
                                           name="kode_perawatan" 
                                           class="form-control" 
                                           value="{{ old('kode_perawatan', $kode_perawatan) }}" 
                                           readonly required />
                                    @error('kode_perawatan')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            


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

      <!-- Prioritas -->
<div class="field item form-group">
    <label class="col-form-label col-md-3 label-align">Prioritas <span class="required">*</span></label>
    <div class="col-md-6">
        <select name="prioritas" id="prioritas" class="form-control" required>
            <option value="">Pilih Prioritas</option>
            <option value="Critical" {{ old('prioritas') == 'Critical' ? 'selected' : '' }}>Critical</option>
            <option value="High" {{ old('prioritas') == 'High' ? 'selected' : '' }}>High</option>
            <option value="Medium" {{ old('prioritas') == 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="Low" {{ old('prioritas') == 'Low' ? 'selected' : '' }}>Low</option>
        </select>
        @error('prioritas')
            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
        @enderror
    </div>
</div>

<!-- Tanggal Batas Pekerjaan -->
<div class="field item form-group">
    <label class="col-form-label col-md-3 label-align">Tanggal Batas Pekerjaan</label>
    <div class="col-md-6">
        <input readonly type="date" name="tanggal_pekerjaan" id="tanggal_pekerjaan"
            value="{{ old('tanggal_pekerjaan') }}" class="form-control">
        @error('tanggal_pekerjaan')
            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
        @enderror
    </div>
</div>



                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Lokasi <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control" required />
                                    @error('lokasi')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>


                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Mekanik <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="mekanik_id" class="form-control" required>
                                        <option value="">Pilih Mekanik</option>
                                        @foreach ($mekaniks as $mekanik)
                                            <option value="{{ $mekanik->id }}" {{ old('mekanik_id') == $mekanik->id ? 'selected' : '' }}>
                                                {{ $mekanik->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mekanik_id')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            {{-- Opsional: catatan_selesai & tanggal_selesai bisa diisi nanti di proses update --}}
                            
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const prioritasSelect = document.getElementById('prioritas');
        const tanggalInput = document.getElementById('tanggal_pekerjaan');

        const updateTanggal = () => {
            if (!prioritasSelect.value) return;

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

            today.setDate(today.getDate() + daysToAdd);
            const formattedDate = today.toISOString().split('T')[0];
            tanggalInput.value = formattedDate;
        };

        // Jalankan saat prioritas berubah
        prioritasSelect.addEventListener('change', updateTanggal);

        // Jalankan langsung jika ada nilai prioritas saat form di-load
        if (prioritasSelect.value && !tanggalInput.value) {
            updateTanggal();
        }
    });
</script>

@endsection
