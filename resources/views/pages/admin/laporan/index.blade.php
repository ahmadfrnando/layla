@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <p class="mb-0 fs-4 fw-bold">Cetak Laporan Baru</p>
        </div>
      </div>
      <form action="{{ route('admin.laporan.cetak') }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="tanggal_mulai" class="form-control-label">Jenis Laporan</label>
                <select class="form-control" name="jenis_laporan" required>
                  <option value="" disabled selected>Pilih Jenis Laporan</option>
                  <option value="hasil_panen">Laporan Hasil Panen</option>
                  <option value="pemupukan">Laporan Pemupukan</option>
                  <option value="pemeliharaan">Laporan Pemeliharaan</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal_mulai" class="form-control-label">Tanggal Mulai</label>
                <input class="form-control" name="tanggal_mulai" type="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal_selesai" class="form-control-label">Tanggal Selesai</label>
                <input class="form-control" name="tanggal_selesai" type="date" required>
                @error('tanggal_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-print me-2"></i>Cetak Laporan</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection