@extends('layouts.afdeling')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="block align-items-center">
          <a href="{{ route('afdeling.jadwal-operasional.index') }}" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <p class="mb-0 fs-4 fw-bold">Buat Jadwal Operasional</p>
        </div>
      </div>
      <form id="tambahJadwal">
        @csrf
        @method('POST')
        <div class="card-body">
          <div class="row">
            <input name="user_id" type="number" value="{{ Auth::user()->id }}" hidden readonly>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggal" class="form-control-label">Tanggal</label>
                <input class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" type="date" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Supir</label>
                <select id="supir" name="nama_supir" style="width: 100%; height: 100%" required>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="kendaraan_pengangkutan" class="form-control-label">Kendaraan</label>
                <select class="form-control @error('kendaraan_pengangkutan') is-invalid @enderror" name="kendaraan_pengangkutan" required>
                  <option value="">Pilih Kendaraan</option>
                  <option value="truk">Truk</option>
                  <option value="motor">Motor</option>
                </select>
                @error('kendaraan_pengangkutan')
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
            <div class="col-md-6">
              <div class="form-group">
                <label for="nomor_polisi" class="form-control-label">Nomor Polisi</label>
                <input class="form-control @error('nomor_polisi') is-invalid @enderror" name="nomor_polisi" type="text" value="{{ old('nomor_polisi') }}" required>
                @error('nomor_polisi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="keterangan" class="form-control-label">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" type="text">{{ old('keterangan') ?? '' }}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data Jadwal</button>
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
    let formSelector = '#tambahJadwal';
    let actionUrl = "{{ route('afdeling.jadwal-operasional.store') }}";
    let successMessage = 'Data berhasil disimpan!';
    let redirectUrl = "{{ route('afdeling.jadwal-operasional.index') }}";
    submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);

    $('#id_kode').select2({
      placeholder: 'Pilih Kode Pengangkutan',
      minimumInputLength: 2,
      allowClear: true,
      width: 'resolve',
      language: {
        inputTooShort: function() {
          return "Masukkan minimal 2 karakter";
        }
      },
      ajax: {
        url: route('search.kode-pengangkutan'),
        dataType: 'json',
        processResults: data => {
          return {
            results: data.map(res => {
              return {
                text: res.kode_pengangkutan,
                id: res.id
              }
            })
          }
        }
      }
    });
    $('#supir').select2({
      placeholder: 'Pilih Supir',
      allowClear: true,
      width: 'resolve',
      language: {
        inputTooShort: function() {
          return "Masukkan minimal 2 karakter";
        }
      },
      ajax: {
        url: route('search.supir'),
        dataType: 'json',
        processResults: data => {
          return {
            results: data.map(res => {
              return {
                text: res.nama,
                id: res.nama
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