@extends('layouts.afdeling')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0 d-flex justify-content-between">
        <div>
          <h6>Data Jadwal Operasional</h6>
          <p class="text-sm">Berikut adalah data jadwal yang telah tercatat.</p>
        </div>
        <div>
          <a href="{{ route('afdeling.jadwal-operasional.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Jadwal</a>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table data-table">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Pengangkutan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Blok</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Supir</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kendaraan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
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
    var route = 'afdeling.jadwal-operasional.index';
    var selector = ".data-table";
    var columns = [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        className: 'w-8 text-center',
        orderable: false,
        searchable: false
      },
      {
        data: 'kode_pengangkutan',
        name: 'kode_pengangkutan',
      },
      {
        data: 'tanggal',
        name: 'tanggal',
        sortable: true,
        render: function(data, type, row) {
          return moment(data).format('DD-MM-YYYY');
        }
      },
      {
        data: 'blok',
        name: 'blok',
      },
      {
        data: 'nama_supir',
        name: 'nama_supir',
      },
      {
        data: 'kendaraan_pengangkutan',
        name: 'kendaraan_pengangkutan',
      },
      {
        data: 'status',
        name: 'status',
        className: 'text-center',
      },
      {
        data: 'keterangan',
        name: 'keterangan',
        className: 'text-wrap',
        render: function(data, type, row) {
          return data ? data : '-';
        }
      },
      {
        data: 'action',
        name: 'action',
        className: 'text-center',
        orderable: false,
        searchable: false
      },
    ];
    var table = initializeDataTable(selector, route, columns);
    $(document).on('click', '#delete', function() {
      var id = $(this).data('id');
      var route = "{{ route('afdeling.jadwal-operasional.destroy', ':id') }}";
      route = route.replace(':id', id);
      deleteDataAjax(route, table);
    });

    $(document).on('click', '#btn-status', function() {
      var id = $(this).data('id');
      var status = $(this).data('status');
      var route = "{{ route('afdeling.jadwal-operasional.status', [':id', ':status']) }}";
      route = route.replace(':id', id).replace(':status', status);
      updateStatusAjax(route, table, status);
    });
  });
</script>
@endpush
@endsection