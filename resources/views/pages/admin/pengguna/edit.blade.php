@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('admin.afdeling.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Ubah Kata Sandi</p>
        </div>
      </div>
      <form id="ubahPassword">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="password" class="form-control-label">Kata Sandi Baru</label>
                <input class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" type="password" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password_confirmation" class="form-control-label">Konfirmasi Kata Sandi</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" type="password" required>
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Kata Sandi</button>
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
    let formSelector = '#ubahPassword';
    let actionUrl = "{{ route('admin.pengguna.update', $user->id) }}";
    let successMessage = 'Kata Sandi berhasil diubah!';
    let redirectUrl = "{{ route('admin.pengguna.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
  });
</script>
@endpush
@endsection