@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between">
                <div>
                    <h6>Data Pemeliharaan Sawit</h6>
                    <p class="text-sm">Berikut adalah data pemeliharaan yang telah tercatat.</p>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Karyawan</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Jenis Pemeliharaan</th>
                                <th width="30%" class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Deskripsi</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7"></th>
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
        var route = 'admin.pemeliharaan.index';
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'tanggal',
                name: 'tanggal',
                className: 'text-sm',
                render: function(data, type, row) {
                    data = new Date(data);
                    var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    var dayName = days[data.getDay()];
                    return dayName + ', ' + data.getDate() + '-' + (data.getMonth() + 1) + '-' + data.getFullYear();
                }
            },
            {
                data: 'karyawan',
                name: 'karyawan',
                className: 'text-sm',
            },
            {
                data: 'jenis_tindakan',
                name: 'jenis_tindakan',
                className: 'text-sm',
            },
            {
                data: 'deskripsi',
                name: 'deskripsi',
                className: 'text-sm',
            },
            {
                data: 'action',
                name: 'action',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ];
        var table = initializeDataTable(selector, route, columns);
        $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            var route = "{{ route('admin.pemeliharaan.destroy', ':id') }}";
            route = route.replace(':id', id);
            deleteDataAjax(route, table);
        });
    })
</script>
@endpush
@endsection