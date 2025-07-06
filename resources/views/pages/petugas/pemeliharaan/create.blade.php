@extends('layouts.petugas')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('petugas.pemeliharaan.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Tambah Data</p>
        </div>
      </div>
      <form id="tambahPemeliharaan">
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
                <label for="jenis_tindakan" class="form-control-label">Jenis Pemeliharaan</label>
                <input class="form-control" name="jenis_tindakan" value="{{ old('jenis_tindakan') }}" type="text" oninput="capitalizeWords(this)" required>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="deskripsi" class="form-control-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data Pemeliharaan</button>
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
    let formSelector = '#tambahPemeliharaan';
    let actionUrl = "{{ route('petugas.pemeliharaan.store') }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('petugas.pemeliharaan.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

  });
</script>
@endpush
@endsection