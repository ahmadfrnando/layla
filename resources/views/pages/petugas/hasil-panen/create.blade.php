@extends('layouts.petugas')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('petugas.hasil-panen.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Tambah Hasil Panen Baru</p>
        </div>
      </div>
      <form id="tambahHasilPanen">
        @csrf
        @method('POST')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal" class="form-control-label">Tanggal</label>
                <input class="form-control" name="tanggal" value="{{ old('tanggal') }}" type="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="karyawan_id" class="form-control-label">Nama Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" style="width: 100%; height: 100%" required>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="blok" class="form-control-label">Blok</label>
                <input class="form-control" name="blok" id="blok" value="{{ old('tanggal') }}" type="text" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="toros_besar_kg" class="form-control-label">Jumlah Toros Besar</label>
                <input class="form-control" id="toros_besar_kg" name="toros_besar_kg" value="{{ old('toros_besar_kg') }}" type="text" required>
                <div class="form-text">Masukkan jumlah muatan dalam satuan kg</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="toros_kecil_kg" class="form-control-label">Jumlah Toros Kecil</label>
                <input class="form-control" id="toros_kecil_kg" name="toros_kecil_kg" value="{{ old('toros_kecil_kg') }}" type="text" required>
                <div class="form-text">Masukkan jumlah muatan dalam satuan kg</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jumlah_kg" class="form-control-label">Jumlah Muatan</label>
                <input class="form-control" id="jumlah_kg" name="jumlah_kg" value="{{ old('jumlah_kg') }}" type="text" readonly required>
                <div class="form-text">Masukkan jumlah muatan dalam satuan kg</div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="catatan" class="form-control-label">Catatan</label>
                <textarea class="form-control" name="catatan" required>{{ old('catatan') }}</textarea>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data Muatan</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@push('scripts')
<script type="text/javascript">
  $(function() {

    $('#toros_besar_kg, #toros_kecil_kg').on('input', function() {
      let torosBesarKg = parseFloat($('#toros_besar_kg').val() || 0);
      let torosKecilKg = parseFloat($('#toros_kecil_kg').val() || 0);
      let totalKg = torosBesarKg + torosKecilKg;
      $('#jumlah_kg').val(totalKg);
    });
    let formSelector = '#tambahHasilPanen';
    let actionUrl = "{{ route('petugas.hasil-panen.store') }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('petugas.hasil-panen.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

    $('#karyawan_id').select2({
      placeholder: 'Pilih Karyawan',
      allowClear: true,
      width: 'resolve',
      ajax: {
        url: route('search.karyawan'),
        dataType: 'json',
        processResults: data => {
          return {
            results: data.map(res => {
              return {
                text: res.nama,
                id: res.id,
              }
            })
          }
        }
      }
    });
  });
</script>
@endpush
@endsection