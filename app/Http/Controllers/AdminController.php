<?php

namespace App\Http\Controllers;

use App\Charts\SubjectValueChart;
use App\Charts\TryoutAVGChart;
use App\Models\Student;
use App\Models\Tryout;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Calendar;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TryoutAVGChart $tryoutAVGChart, SubjectValueChart $subjectValueChart)
    {
        $tryoutAVG = $tryoutAVGChart->build();
        $subjectValue = $subjectValueChart->build();
        // Mengambil jumlah student
        $studentCount = Student::count();
        return view('admin.dashboard', compact('studentCount','tryoutAVG','subjectValue')); 
        // return "test bang"; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function individu()
    {
        $students = Student::all();
        return view('admin.individu',compact('students'));
    }

    public function detail($id){

        $students = DB::table('students')
            ->where('id', '=', $id)
            ->first();

        return view('admin.detail', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
    * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function dashboard()
    {
        $events = Event::all();
        $event_list = [];

        foreach ($events as $event) {
            $event_list[] = Calendar::event(
                $event->title,
                true,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date.' +1 day')
            );
        }

        $calendar_details = Calendar::addEvents($event_list);

        return view('admin.dashboard', compact('calendar_details'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
