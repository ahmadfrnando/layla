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

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $currentMonth = date('m');
        $data = Pemupukan::whereMonth('tanggal', $currentMonth)
            ->selectRaw('SUM(jumlah_kg) as total, tanggal as day')
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return $this->chart->lineChart()
            ->setTitle("Pemupukan Bulanan ( ".date('M')." )")
            ->setSubtitle('Jumlah Puupuk dalam satuan Kg')
            ->addData('Jumlah Pupuk (Kg)', $data->pluck('total')->map(fn($item) => $item . ' Kg')->toArray())
            ->setXAxis($data->pluck('day')->toArray());
    }
}
