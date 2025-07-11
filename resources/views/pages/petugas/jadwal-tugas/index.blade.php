@extends('layouts.petugas')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between">
                <div>
                    <h6>Data Tugas</h6>
                    <p class="text-sm">Berikut adalah data jadwal yang telah tercatat.</p>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Status</th>
                                <th width="30%" class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Deskripsi</th>
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
        var route = 'petugas.jadwal-tugas.index';
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'tanggal_tugas',
                name: 'tanggal_tugas',
                className: 'text-sm',
            },
            {
                data: 'status',
                name: 'status',
                className: 'text-center text-sm',
            },
            {
                data: 'deskripsi_tugas',
                name: 'deskripsi_tugas',
                className: 'text-sm',
            },
        ];
        var table = initializeDataTable(selector, route, columns);

        $(document).on('click', '#btn-status', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            var route = "{{ route('petugas.jadwal-tugas.status', [':id', ':status']) }}";
            route = route.replace(':id', id).replace(':status', status);
            updateStatusAjax(route, table, status);
        });
    })
</script>
@endpush
@endsection