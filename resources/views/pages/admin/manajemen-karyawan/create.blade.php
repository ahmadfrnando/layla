@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('admin.manajemen-karyawan.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Tambah Karyawan Baru</p>
        </div>
      </div>
      <form id="tambahKaryawan">
        @csrf
        @method('POST')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control" name="nama" value="{{ old('nama') }}" type="text" required oninput="capitalizeWords(this)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                <input class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" type="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jabatan" class="form-control-label">Jabatan</label>
                <input class="form-control" name="jabatan" value="{{ old('jabatan') }}" type="text" oninput="capitalizeWords(this)" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="no_telp" class="form-control-label">Nomor Telepon</label>
                <input class="form-control" name="no_telp" value="{{ old('no_telp') }}" type="number" required>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="alamat" class="form-control-label">Alamat</label>
                <textarea class="form-control" name="alamat" required>{{ old('alamat') }}</textarea>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data Karyawan</button>
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
    let formSelector = '#tambahKaryawan';
    let actionUrl = "{{ route('admin.manajemen-karyawan.store') }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('admin.manajemen-karyawan.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
  });
</script>
@endpush
@endsection