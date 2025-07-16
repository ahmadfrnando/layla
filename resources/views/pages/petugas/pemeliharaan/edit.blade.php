@extends('layouts.petugas')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('petugas.pemeliharaan.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Ubah Data</p>
        </div>
      </div>
      <form id="ubahPemeliharaan">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal" class="form-control-label">Tanggal</label>
                <input class="form-control" name="tanggal" value="{{ old('tanggal', $pemeliharaan->tanggal) }}" type="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Nama Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" style="width: 100%; height: 100%" required>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jenis_tindakan" class="form-control-label">Jenis Pemeliharaan</label>
                <input class="form-control" name="jenis_tindakan" value="{{ old('jenis_tindakan', $pemeliharaan->jenis_tindakan) }}" type="text" oninput="capitalizeWords(this)" required>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="deskripsi" class="form-control-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi', $pemeliharaan->deskripsi) }}</textarea>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan Pemeliharaan</button>
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
    let formSelector = '#ubahPemeliharaan';
    let actionUrl = "{{ route('petugas.pemeliharaan.update',  $pemeliharaan->id) }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('petugas.pemeliharaan.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
    $('#karyawan_id').select2({
      placeholder: 'Pilih Karyawan',
      allowClear: true,
      width: 'resolve',
      data: [{
        id: "{{ $pemeliharaan->karyawan_id }}",
        text: "{{ $pemeliharaan->karyawan->nama }}"
      }]
      ajax: {
        url: route('search.karyawan'),
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