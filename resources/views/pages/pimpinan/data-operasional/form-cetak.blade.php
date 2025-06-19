@extends('layouts.pimpinan')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('pimpinan.data-operasional.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Cetak Laporan Baru</p>
        </div>
      </div>
      <form action="{{ route('pimpinan.data-operasional.cetak') }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal_mulai" class="form-control-label">Tanggal Mulai</label>
                <input class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" type="date" required>
                @error('tanggal_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal_selesai" class="form-control-label">Tanggal Selesai</label>
                <input class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai" type="date" required>
                @error('tanggal_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Cetak Laporan</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection