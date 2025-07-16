@extends('layouts.petugas')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('petugas.hasil-panen.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Ubah Data Muatan</p>
        </div>
      </div>
      <form id="ubahHasilPanen">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal" class="form-control-label">Tanggal</label>
                <input class="form-control" name="tanggal" value="{{ old('tanggal', $hasilPanen->tanggal) }}" type="date" required>
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
                <label for="jumlah_kg" class="form-control-label">Jumlah</label>
                <input class="form-control" value="{{ old('jumlah_kg', $hasilPanen->jumlah_kg) }}" name="jumlah_kg" type="number" required>
                <div class="form-text">Masukkan jumlah muatan dalam satuan kg</div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="catatan" class="form-control-label">Catatan</label>
                <textarea class="form-control" name="catatan" type="text" required>{{ old('catatan', $hasilPanen->catatan) }}</textarea>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Ubah Data Muatan</button>
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
    let formSelector = '#ubahHasilPanen';
    let actionUrl = "{{ route('petugas.hasil-panen.update', $hasilPanen->id) }}";
    let successMessage = 'Data berhasil diubah!';
    let redirectUrl = "{{ route('petugas.hasil-panen.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

    $('#karyawan_id').select2({
      placeholder: 'Pilih Karyawan',
      allowClear: true,
      width: 'resolve',
      data: [{
        id: "{{ $hasilPanen->karyawan_id }}",
        text: "{{ $hasilPanen->karyawan->nama }}"
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