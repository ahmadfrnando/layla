@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('admin.pengaturan-pengguna.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Tambah Pengguna</p>
        </div>
      </div>
      <form id="tambahPengguna">
        @csrf
        @method('POST')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" style="width: 100%; height: 100%" required>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="username" class="form-control-label">Username</label>
                <input class="form-control" id="username" name="username" value="{{ old('username') }}" type="text" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password" class="form-control-label">Password</label>
                <input class="form-control" id="password" name="password" value="{{ old('password') }}" type="password" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password_confirmation" class="form-control-label">Konfirmasi Password</label>
                <input class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" type="password" required>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data Pengguna</button>
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
    let formSelector = '#tambahPengguna';
    let actionUrl = "{{ route('admin.pengaturan-pengguna.store') }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('admin.pengaturan-pengguna.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

    $('#karyawan_id').select2({
      placeholder: 'Pilih Karyawan',
      allowClear: true,
      width: 'resolve',
      ajax: {
        url: route('search.karyawan-pengguna'),
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