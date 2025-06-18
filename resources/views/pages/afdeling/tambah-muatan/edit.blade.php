@extends('layouts.afdeling')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('afdeling.tambah-muatan.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Ubah Data Muatan</p>
        </div>
      </div>
      <form id="updateMuatan">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Kode Pengangkutan</label>
                <input class="form-control" type="text" value="{{ $pengangkutan->pengangkutan->kode_pengangkutan ?? '-' }}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal" class="form-control-label">Tanggal</label>
                <input class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" type="date" value="{{ $pengangkutan->tanggal }}" required>
                @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="muatan_afdeling" class="form-control-label">Muatan</label>
                <input class="form-control @error('muatan_afdeling') is-invalid @enderror" name="muatan_afdeling" type="number" value="{{ old('muatan_afdeling', $pengangkutan->muatan_afdeling) }}" required>
                @error('muatan_afdeling')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tandan_afdeling" class="form-control-label">Tandan</label>
                <input class="form-control @error('tandan_afdeling') is-invalid @enderror" name="tandan_afdeling" type="number" value="{{ old('tandan_afdeling', $pengangkutan->tandan_afdeling) }}" required>
                @error('tandan_afdeling')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data Muatan</button>
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
    let formSelector = '#updateMuatan';
    let actionUrl = "{{ route('afdeling.tambah-muatan.update', $pengangkutan->id) }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('afdeling.tambah-muatan.index') }}";
    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
  });
</script>
@endpush
@endsection