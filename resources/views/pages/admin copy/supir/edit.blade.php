@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('admin.supir.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Ubah Data Supir</p>
        </div>
      </div>
      <form id="ubahSupir">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $supir->nama) }}" type="text" required>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="no_hp" class="form-control-label">Nomor Hp</label>
                <input class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $supir->no_hp) }}" name="no_hp" type="text" required>
                @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data Supir</button>
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
    let formSelector = '#ubahSupir';
    let actionUrl = "{{ route('admin.supir.update', $supir->id) }}";
    let successMessage = 'Data berhasil diubah!';
    let redirectUrl = "{{ route('admin.supir.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
  });
</script>
@endpush
@endsection