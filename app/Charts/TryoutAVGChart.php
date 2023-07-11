<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class TryoutAVGChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tryoutNames = [];
        $tryoutAVG = [];

        $result = DB::table('values')
            ->join('tryouts', 'values.tryout_id', '=', 'tryouts.id')
            ->select('tryouts.id','tryouts.tryout_name', DB::raw('ROUND(AVG(values.value)) AS average_score'))
            ->groupBy('tryouts.id','tryouts.tryout_name')
            ->get();

        foreach ($result as $row) {
            $tryoutNames[] = $row->tryout_name;
            $tryoutAVG[] = $row->average_score;
        }

        return $this->chart->lineChart()
            // ->setSubtitle('Grafik nilai tryout')
            ->setHeight(200)
            // ->addData('Physical sales', [40, 93, 35, 42, 18, 82])
            ->addData('Tryout', $tryoutAVG)
            ->setXAxis($tryoutNames);
    }
}
