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
          <p class="mb-0 fs-4 fw-bold">Ubah Karyawan</p>
        </div>
      </div>
      <form id="ubahKaryawan">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control" name="nama" value="{{ old('nama', $karyawan->nama) }}" type="text" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jabatan" class="form-control-label">Jabatan</label>
                <input class="form-control" value="{{ old('jabatan', $karyawan->jabatan) }}" name="jabatan" type="text" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="no_telp" class="form-control-label">Nomor Telepon</label>
                <input class="form-control" value="{{ old('no_telp', $karyawan->no_telp) }}" name="no_telp" type="text" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="alamat" class="form-control-label">Alamat</label>
                <textarea class="form-control" name="alamat" type="text" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Ubah Data Karyawan</button>
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
    let formSelector = '#ubahKaryawan';
    let actionUrl = "{{ route('admin.manajemen-karyawan.update', $karyawan->id) }}";
    let successMessage = 'Data berhasil diubah!';
    let redirectUrl = "{{ route('admin.manajemen-karyawan.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
  });
</script>
@endpush
@endsection