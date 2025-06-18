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
          <p class="mb-0 fs-4 fw-bold">Tambah Afdeling Baru</p>
        </div>
      </div>
      <form id="tambahAfdeling">
        @csrf
        @method('POST')
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" type="text" required>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="no_hp" class="form-control-label">Nomor Hp</label>
                <input class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" type="text" required>
                @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="blok" class="form-control-label">Blok</label>
                <select class="form-control @error('blok') is-invalid @enderror" name="blok" required>
                  <option value="">Pilih Blok</option>
                  @foreach($blok as $b)
                  <option value="{{ $b->blok }}">{{ $b->blok }}</option>
                  @endforeach
                </select>
                @error('blok')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data Afdeling</button>
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
    let formSelector = '#tambahAfdeling';
    let actionUrl = "{{ route('admin.afdeling.store') }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('admin.afdeling.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
  });
</script>
@endpush
@endsection