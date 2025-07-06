@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('admin.jadwal-tugas.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Ubah Jadwal</p>
        </div>
      </div>
      <form id="ubahJadwal">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal_tugas" class="form-control-label">Tanggal Tugas</label>
                <input class="form-control" name="tanggal_tugas" value="{{ old('tanggal_tugas', $jadwalTugas->tanggal_tugas) }}" type="date" required>
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
                <label for="jenis_pupuk" class="form-control-label">Status</label>
                <select id="status" name="status" class="form-control" required>
                  <option value="">Pilih Status</option>
                  <option value="proses" {{ old('status', $jadwalTugas->status) == 'proses' ? 'selected' : '' }}>Belum Selesai</option>
                  <option value="selesai" {{ old('status', $jadwalTugas->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="deskripsi_tugas" class="form-control-label">Deskripsi Tugas</label>
                <textarea class="form-control" name="deskripsi_tugas" type="text" required>{{ old('deskripsi_tugas', $jadwalTugas->deskripsi_tugas) }}</textarea>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Ubah Data Jadwal</button>
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
    let formSelector = '#ubahJadwal';
    let actionUrl = "{{ route('admin.jadwal-tugas.update', $jadwalTugas->id) }}";
    let successMessage = 'Data berhasil diubah!';
    let redirectUrl = "{{ route('admin.jadwal-tugas.index') }}";

    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

    $('#karyawan_id').select2({
      placeholder: 'Pilih Karyawan',
      allowClear: true,
      width: 'resolve',
      data: [{
        id: '{{ $jadwalTugas->karyawan->id }}',
        text: '{{ $jadwalTugas->karyawan->nama }}'
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