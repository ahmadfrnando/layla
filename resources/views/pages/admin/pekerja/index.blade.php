@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Data Pekerja</h6>
        <p class="text-sm">Berikut adalah data pekerja yang telah tercatat.</p>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table data-table">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pekerja</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Telepon</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Posisi</th>
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
    var columns = [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        className: 'w-8 text-center',
        orderable: false,
        searchable: false
      },
      {
        data: 'nama',
        name: 'nama',
      },
      {
        data: 'email',
        name: 'email',
      },
      {
        data: 'no_tlp',
        name: 'no_tlp',
      },
      {
        data: 'role',
        name: 'role',
      },
      {
        data: 'action',
        name: 'action',
        className: 'text-center',
        orderable: false,
        searchable: false
      }
    ];
    initializeDataTable('.data-table', 'admin.pekerja.index', columns);
  });
</script>
@endpush
@endsection