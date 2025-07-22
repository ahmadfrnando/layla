@extends('layouts.manajer')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="p-6 m-20 bg-white rounded shadow">
                {!! $chart->container() !!}
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between">
                <div>
                    <h6>Data Hasil Panen</h6>
                    <p class="text-sm">Berikut adalah data hasil panen yang telah tercatat.</p>
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
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Jumlah Panen</th>
                                <th width="30%" class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Catatan</th>
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
        var route = 'manajer.hasil-panen.index';
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
                data: 'jumlah_kg',
                name: 'jumlah_kg',
                className: 'text-sm',
                render: function(data, type, row) {
                    return data + ' Kg';
                }
            },
            {
                data: 'catatan',
                name: 'catatan',
                className: 'text-sm',
            }
        ];
        var table = initializeDataTable(selector, route, columns);
    })
</script>
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endpush
@endsection