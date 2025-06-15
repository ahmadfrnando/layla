@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Data Pemupukan</h6>
        <p class="text-sm">Berikut adalah data Pemupukan yang telah tercatat.</p>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table data-table">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pegawai</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Pupuk</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script type="text/javascript">
  $(function() {
    var columns = [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        className: 'w-8 text-center',
        orderable: false,
        searchable: false
      },
      {
        data: 'pekerja',
        name: 'pekerja',
      },
      {
        data: 'tanggal',
        name: 'tanggal',
        render: function(data, type, row) {
          return moment(data).format('DD-MM-YYYY');
        }
      },
      {
        data: 'jenis_pupuk',
        name: 'jenis_pupuk',
      },
      {
        data: 'jumlah',
        name: 'jumlah',
        render: function(data, type, row) {
          return parseFloat(data).toFixed(2) + ' kg'; 
        }
      },
      {
        data: 'keterangan',
        name: 'keterangan',
      },
    ];
    initializeDataTable('.data-table', 'admin.pemupukan.index', columns);
  });
</script>
@endpush
@endsection