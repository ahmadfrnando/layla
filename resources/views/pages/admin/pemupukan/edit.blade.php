@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('admin.pemupukan.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Ubah Data Pemupukan</p>
        </div>
      </div>
      <form id="ubahPemupukan">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal" class="form-control-label">Tanggal</label>
                <input class="form-control" name="tanggal" value="{{ old('tanggal', $pemupukan->tanggal) }}" type="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="karyawan_id" class="form-control-label">Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" style="width: 100%; height: 100%" required>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jenis_pupuk" class="form-control-label">Jenis Pupuk</label>
                <input class="form-control" name="jenis_pupuk" value="{{ old('jenis_pupuk', $pemupukan->jenis_pupuk) }}" type="text" oninput="capitalizeWords(this)" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jumlah_kg" class="form-control-label">Jumlah</label>
                <input class="form-control" value="{{ old('jumlah_kg', $pemupukan->jumlah_kg) }}" name="jumlah_kg" type="number" required>
                <div class="form-text">Masukkan jumlah pupuk dalam satuan kg</div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="catatan" class="form-control-label">Catatan</label>
                <textarea class="form-control" name="catatan" type="text" required>{{ old('catatan', $pemupukan->catatan) }}</textarea>
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
    let formSelector = '#ubahPemupukan';
    let actionUrl = "{{ route('admin.pemupukan.update', $pemupukan->id) }}";
    let successMessage = 'Data berhasil diubah!';
    let redirectUrl = "{{ route('admin.pemupukan.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

    $('#karyawan_id').select2({
      placeholder: 'Pilih Karyawan',
      allowClear: true,
      width: 'resolve',
      data: [{
        id: '{{ $pemupukan->karyawan->id }}',
        text: '{{ $pemupukan->karyawan->nama }}'
      }],
      ajax: {
        url: route('search.karyawan'),
        dataType: 'json',
        processResults: data => {
          return {
            results: data.map(res => {
              return {
                text: res.nama,
                id: res.id
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