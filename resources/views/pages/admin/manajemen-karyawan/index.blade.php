@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between">
                <div>
                    <h6>Data Karyawan</h6>
                    <p class="text-sm">Berikut adalah data karyawan yang telah tercatat.</p>
                </div>
                <div>
                    <a href="{{ route('admin.manajemen-karyawan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Karyawan</a>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Nama</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Jabatan</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">No Telepon</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Alamat</th>
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
        var route = 'admin.manajemen-karyawan.index';
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama',
                name: 'nama',
                className: 'text-sm',
            },
            {
                data: 'jabatan',
                name: 'jabatan',
                className: 'text-sm',
            },
            {
                data: 'no_telp',
                name: 'no_telp',
                className: 'text-sm',
            },
            {
                data: 'alamat',
                name: 'alamat',
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
            var route = "{{ route('admin.manajemen-karyawan.destroy', ':id') }}";
            route = route.replace(':id', id);
            deleteDataAjax(route, table);
        });
    })
</script>
@endpush
@endsection