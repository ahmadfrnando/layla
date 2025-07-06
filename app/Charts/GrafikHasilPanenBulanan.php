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

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $currentMonth = date('m');
        $data = HasilPanen::whereMonth('tanggal', $currentMonth)
            ->selectRaw('SUM(jumlah_kg) as total, tanggal as day')
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return $this->chart->lineChart()
            ->setTitle("Hasil Panen Bulanan ( ".date('M')." )")
            ->setSubtitle('Muatan dalam satuan Kg')
            ->addData('Data Muatan (Kg)', $data->pluck('total')->map(fn($item) => $item . ' Kg')->toArray())
            ->setXAxis($data->pluck('day')->toArray());
    }
}
