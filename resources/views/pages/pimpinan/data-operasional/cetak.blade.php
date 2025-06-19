<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <style>
        .table td,
        .table th {
            padding: 0.5rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .signature {
            margin-top: 50px;
            text-align: left;
        }
    </style>
    <script>
        window.print();
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h4>LAPORAN DATA OPERASIONAL</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>{{ $tanggal_mulai }} - {{ $tanggal_selesai }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th>Tanggal</th>
                                <th>Kode Pengangkutan</th>
                                <th>Afdeling</th>
                                <th>Supir</th>
                                <th>Blok</th>
                                <th>Muatan Afdeling</th>
                                <th>Tandan Afdeling</th>
                                <th>Muatan Pabrik</th>
                                <th>Tandan Pabrik</th>
                                <th>Muatan Hilang</th>
                                <th>Tandan Hilang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->pengangkutan->kode_pengangkutan }}</td>
                                <td>{{ $item->afdeling->name }}</td>
                                <td>{{ $item->pengangkutan->nama_supir }}</td>
                                <td>{{ $item->pengangkutan->blok }}</td>
                                <td>{{ $item->muatan_afdeling }}</td>
                                <td>{{ $item->tandan_afdeling }}</td>
                                <td>{{ $item->muatan_pabrik }}</td>
                                <td>{{ $item->tandan_pabrik }}</td>
                                <td>{{ $item->muatan_hilang }}</td>
                                <td>{{ $item->tandan_hilang }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 signature">
                <p>Mengetahui,</p>
                <p>Pimpinan</p>
            </div>
        </div>
    </div>

</body>

</html>