@extends('layouts.pimpinan')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0 d-flex justify-content-between">
        <div>
          <h6>Data Operasional</h6>
          <p class="text-sm">Berikut adalah data operasional yang telah tercatat.</p>
        </div>
        <div>
          <a href="{{ route('pimpinan.data-operasional.form-cetak') }}" class="btn btn-primary"><i class="fas fa-print me-2"></i>Cetak Laporan</a>
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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Afdeling</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Supir</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Blok</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Muatan Afdeling</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tandan Afdeling</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Muatan Pabrik</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tandan Pabrik</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Muatan Hilang</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tandan Hilang</th>
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
    var route = 'pimpinan.data-operasional.index';
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
        data: 'afdeling',
        name: 'afdeling',
      },
      {
        data: 'supir',
        name: 'supir',
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
        data: 'muatan_pabrik',
        name: 'muatan_pabrik',
      },
      {
        data: 'tandan_pabrik',
        name: 'tandan_pabrik',
      },
      {
        data: 'muatan_hilang',
        name: 'muatan_hilang',
      },
      {
        data: 'tandan_hilang',
        name: 'tandan_hilang',
      },
      {
        data: 'keterangan',
        name: 'keterangan',
        className: 'text-wrap',
        render: function(data, type, row) {
          return data ? data : '-';
        }
      },
    ];
    var table = initializeDataTable(selector, route, columns);

    table.on('draw', function() {
      table.rows().every(function(rowIdx, tableLoop, rowLoop) {
        var row = table.row(rowIdx).node();
        var muatanHilang = table.cell(row, 'muatan_hilang:name').data();
        var tandanHilang = table.cell(row, 'tandan_hilang:name').data();

        // Cek jika muatan_hilang lebih dari 0
        if (muatanHilang > 0 || tandanHilang > 0) {
          $(row).addClass('red-row');
        } else {
          $(row).removeClass('red-row');
        }
      });
    });
  });
</script>
@endpush
@endsection