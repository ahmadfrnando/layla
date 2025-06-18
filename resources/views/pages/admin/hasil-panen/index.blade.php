@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0 d-flex justify-content-between">
        <div>
          <h6>Data Hasil Panen</h6>
          <p class="text-sm">Berikut adalah data hasil panen yang telah tercatat.</p>
        </div>
        <div class="col-lg-6 col-md-8 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " id="semua-pengangkutan-tab" data-bs-target="#semua-pengangkutan" aria-controls="semua-pengangkutan" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                  <i class="fas fa-list"></i>
                  <span class="ms-2">Semua Pengangkutan</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " id="input-pengangkutan-tab" data-bs-target="#input-pengangkutan" aria-controls="input-pengangkutan" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="fas fa-check"></i>
                  <span class="ms-2">Input Hasil Pengangkutan</span>
                </a>
              </li>
            </ul>
          </div>
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
  $(document).ready(function() {
    $('#semua-pengangkutan-tab').click();
  })
  $('#input-pengangkutan-tab').click(function() {
    var route = 'admin.hasil-panen.create';
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
        data: 'blok',
        name: 'blok',
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
      }
    ];
    initializeDataTable(selector, route, columns);
  })
  $('#semua-pengangkutan-tab').click(function() {
    var route = 'admin.hasil-panen.index';
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
        render: function(data, type, row) {
          return moment(data).format('YYYY-MM-DD');
        },
        type: 'date'
      },
      {
        data: 'kode_pengangkutan',
        name: 'kode_pengangkutan',
        orderable: true
      },
      {
        data: 'afdeling',
        name: 'afdeling',
      },
      {
        data: 'blok',
        name: 'blok',
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
      }
    ];
    initializeDataTable(selector, route, columns);
  })
</script>
@endpush
@endsection