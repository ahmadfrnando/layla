@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('admin.hasil-panen.index') }}" class="btn btn-secondary btn-sm me-2">
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
                <label for="example-text-input" class="form-control-label">Nama Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" style="width: 100%; height: 100%" required>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jumlah_kg" class="form-control-label">Jumlah Muatan</label>
                <input class="form-control" id="jumlah_kg" name="jumlah_kg" value="{{ old('jumlah_kg') }}" type="text" required>
                <div class="form-text">Masukkan jumlah muatan dalam satuan kg</div>
              </div>
            </div>
            <div class="col-md-6">
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
    let formSelector = '#tambahHasilPanen';
    let actionUrl = "{{ route('admin.hasil-panen.store') }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('admin.hasil-panen.index') }}";

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