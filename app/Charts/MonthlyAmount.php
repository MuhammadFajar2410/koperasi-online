<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyAmount
{
    protected $chart;


    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;

    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('Perkembangan Transaksi Tahunan');
    }
}
