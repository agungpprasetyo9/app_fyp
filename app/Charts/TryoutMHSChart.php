<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class TryoutMHSChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {   

        $tryoutNames = [];
        $tryoutValues = [];
        $studentId = Auth::id();
        
        $result = DB::table('tryouts')
            ->join('values', 'tryouts.id', '=', 'values.tryout_id')
            ->join('students', 'values.student_id', '=', 'students.id')
            ->where('students.id', '=', $studentId)
            ->select('tryouts.tryout_name',DB::raw('CAST(ROUND(values.value) AS CHAR) as score') )
            ->groupBy('tryouts.tryout_name')
            ->get();

        
        foreach ($result as $row) {
            $tryoutNames[] = $row->tryout_name;
            $tryoutValues[] = $row->score;
        }
        return $this->chart->lineChart()
            ->setTitle('INI title')
            ->setHeight(200)
            ->addData('Tryout', $tryoutValues)
            ->setXAxis($tryoutNames);
    }
}
