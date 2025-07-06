@extends('layouts.petugas')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('petugas.pemupukan.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Tambah Data Pemupukan</p>
        </div>
      </div>
      <form id="tambahPemupukan">
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
                <label for="jenis_pupuk" class="form-control-label">Jenis Pupuk</label>
                <input class="form-control" id="jenis_pupuk" name="jenis_pupuk" value="{{ old('jenis_pupuk') }}" type="text" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jumlah_kg" class="form-control-label">Jumlah Pupuk</label>
                <input class="form-control" id="jumlah_kg" name="jumlah_kg" value="{{ old('jumlah_kg') }}" type="number" required>
                <div class="form-text">Masukkan jumlah pupuk dalam satuan kg</div>
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
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
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
    let formSelector = '#tambahPemupukan';
    let actionUrl = "{{ route('petugas.pemupukan.store') }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('petugas.pemupukan.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
  });
</script>
@endpush
@endsection