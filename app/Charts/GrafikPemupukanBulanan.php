<?php

namespace App\Charts;

use App\Models\HasilPanen;
use App\Models\Pemupukan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class GrafikPemupukanBulanan
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $currentYear = date('Y'); // Ambil tahun ini
        $data = Pemupukan::whereYear('tanggal', $currentYear) // Ambil data tahun ini
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
            ->setTitle("Data Pempukan Tahun " . date('Y'))
            ->setSubtitle('Muatan dalam satuan Kg')
            ->addData('Pemupukan (Kg)', array_values($totalsPerMonth)) // Menambahkan data total per bulan
            ->setLabels($months) // Menetapkan bulan sebagai label sumbu X
            ->setColors(['#D32F2F', '#03A9F4']);
    }
}
