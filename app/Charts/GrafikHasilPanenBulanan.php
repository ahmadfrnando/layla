<?php

namespace App\Charts;

use App\Models\HasilPanen;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class GrafikHasilPanenBulanan
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    // public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    // {
    //     $currentYear = date('y');
    //     $month = date('m');
    //     $data = HasilPanen::whereMonth('tanggal', $currentYear)
    //         ->selectRaw('SUM(jumlah_kg) as total, tanggal as day')
    //         ->groupBy('day')
    //         ->orderBy('day')
    //         ->get();

    //     return $this->chart->lineChart()
    //         ->setTitle("Hasil Panen Bulanan ( ".date('M')." )")
    //         ->setSubtitle('Muatan dalam satuan Kg')
    //         ->addData('Data Muatan (Kg)', $data->pluck('total')->map(fn($item) => $item . ' Kg')->toArray())
    //         ->setXAxis($data->pluck('day')->toArray());
    // }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $currentYear = date('Y'); // Ambil tahun ini
        $data = HasilPanen::whereYear('tanggal', $currentYear) // Ambil data tahun ini
            ->selectRaw('SUM(jumlah_kg) as total, MONTH(tanggal) as month') // Jumlahkan per bulan
            ->groupBy('month') // Kelompokkan berdasarkan bulan
            ->orderBy('month') // Urutkan berdasarkan bulan
            ->get();

        // Buat array bulan-bulan yang akan digunakan sebagai label di sumbu X
        $months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        // Pastikan data ada untuk semua bulan (misalnya jika tidak ada data untuk bulan tertentu, berikan nilai 0)
        $totalsPerMonth = [];
        foreach ($months as $index => $month) {
            $totalsPerMonth[$month] = 0; // Set default ke 0
        }

        // Masukkan total hasil panen per bulan
        foreach ($data as $item) {
            $monthIndex = (int) $item->month - 1; // Bulan dimulai dari 1, jadi dikurangi 1 untuk array
            $totalsPerMonth[$months[$monthIndex]] = $item->total; // Isi dengan total hasil panen per bulan
        }

        // Kembalikan chart bar dengan data yang telah diproses
        return $this->chart->barChart()
            ->setTitle("Hasil Panen Tahun " . date('Y'))
            ->setSubtitle('Muatan dalam satuan Kg')
            ->addData('Hasil Panen (Kg)', array_values($totalsPerMonth)) // Menambahkan data total per bulan
            ->setLabels($months) // Menetapkan bulan sebagai label sumbu X
            ->setColors(['#D32F2F', '#03A9F4']);
    }
}
