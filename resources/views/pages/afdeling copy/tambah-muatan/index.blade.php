@extends('layouts.afdeling')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0 d-flex justify-content-between">
        <div>
          <h6>Data Hasil Panen</h6>
          <p class="text-sm">Berikut adalah data hasil panen yang telah tercatat.</p>
        </div>
        <div>
          <a href="{{ route('afdeling.tambah-muatan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Muatan Baru</a>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table data-table">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Pengangkutan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Blok</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Muatan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tandan</th>
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
    var route = 'afdeling.tambah-muatan.index';
    var selector = ".data-table";
    var columns = [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        className: 'w-8 text-center',
        orderable: false,
        searchable: false
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
        data: 'kode_pengangkutan',
        name: 'kode_pengangkutan',
      },
      {
        data: 'blok',
        name: 'blok',
      },
      {
        data: 'muatan_afdeling',
        name: 'muatan_afdeling',
      },
      {
        data: 'tandan_afdeling',
        name: 'tandan_afdeling',
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
      var route = "{{ route('afdeling.tambah-muatan.destroy', ':id') }}";
      route = route.replace(':id', id);
      deleteDataAjax(route, table);
    });
  });
</script>
@endpush
@endsection