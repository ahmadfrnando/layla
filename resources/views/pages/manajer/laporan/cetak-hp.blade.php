<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Hasil Panen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .date-range {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="title">
        <h2>Laporan Hasil Panen</h2>
    </div>
    <div class="date-range">
        <p>Periode: {{ $tanggal_mulai }} - {{ $tanggal_selesai }}</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Blok</th>
                <th rowspan="2">Nama Karyawan</th>
                <th colspan="2">Toros</th>
                <th rowspan="2">Jumlah</th>
            </tr>
            <tr>
                <th>Besar</th>
                <th>Kecil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($models as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->blok }}</td>
                <td>{{ $item->karyawan->nama }}</td>
                <td>{{ $item->toros_besar_kg }}</td>
                <td>{{ $item->toros_kecil_kg }}</td>
                <td>{{ $item->jumlah_kg }}</td>
            </tr>
            @endforeach
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>

</html>
