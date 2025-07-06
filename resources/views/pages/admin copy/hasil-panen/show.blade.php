@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('admin.hasil-panen.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Input Hasil Panen</p>
        </div>
      </div>
      <form id="updateHasilPanen">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Kode Pengangkutan</label>
                <input class="form-control" type="text" value="{{ $pengangkutan->pengangkutan->kode_pengangkutan }}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Muatan</label>
                <input class="form-control @error('muatan_pabrik') is-invalid @enderror" name="muatan_pabrik" step="0.01" type="number" value="{{ old('muatan_pabrik', $pengangkutan->muatan_pabrik) }}" required>
                @error('muatan_pabrik')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Tandan</label>
                <input class="form-control @error('tandan_pabrik') is-invalid @enderror" name="tandan_pabrik" type="number" value="{{ old('tandan_pabrik', $pengangkutan->tandan_pabrik) }}" required>
                @error('tandan_pabrik')
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
    let formSelector = '#updateHasilPanen';
    let actionUrl = "{{ route('admin.hasil-panen.update', $pengangkutan->id) }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('admin.hasil-panen.index') }}";
    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
  });
</script>
@endpush
@endsection