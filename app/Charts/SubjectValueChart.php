<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class SubjectValueChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {

        $subjectNames = [];
        $subjectAVG = [];

        $result = DB::table('values')
            ->join('subjects', 'values.subject_id', '=', 'subjects.id')
            ->select('subjects.subject_name', DB::raw('ROUND(AVG(values.value)) AS average_score'))
            ->groupBy('subjects.subject_name')
            ->get();

        foreach ($result as $row) {
            $subjectNames[] = $row->subject_name;
            $subjectAVG[] = $row->average_score;
        }
        return $this->chart->horizontalBarChart()
            ->setTitle('Statistik Nilai per Subjek')
            // ->setSubtitle('')
            // ->setColors('#FFC107', '#D32F2F','#ffc63b', '#ff6384', '#D32F2F','#ffc63b')
            ->setHeight(200)
            ->addData('Subject', $subjectAVG)
            ->setXAxis($subjectNames);
    }
}
