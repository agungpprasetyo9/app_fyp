<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\TryoutMHSChart;
use App\Models\Major;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TryoutMHSChart $TryoutMHSChart)
    {
        //ambil nama
        $Id = Auth::id();
        $email = User::where('id', '=', 14)->select('email')->first();
        $email = $email->email;
        $student = Student::where('user_id', '=', 14)->first();
        if ($student) {
            $name = $student->name;
        } else {
            // Student dengan user_id = 1 tidak ditemukan
            $name = null;
        }
        //chart
        $tryout = $TryoutMHSChart->build();
        $students = Student::all();

        
        return view('student.dashboard',compact('tryout', 'name','email','students'));
    }

    public function recommendation(Request $request){
        $tryoutNames = [];
        $tryoutValues = [];
        $studentId = Auth::id();

        
        $averageValue = DB::table('values as v')
            ->join('tryouts', 'v.tryout_id', '=', 'tryouts.id')
            ->crossJoin(DB::raw('(SELECT COUNT(id) AS total_tryouts FROM tryouts) AS subquery'))
            ->where('v.student_id', '=', $studentId)
            ->selectRaw('SUM(v.value) / (subquery.total_tryouts) AS average')
            ->first();

        // Ambil input dari form atau request
        $value = $averageValue->value;
        $jurusanId = $request->input('id');
        $universitasId = $request->input('id');

        // Mendapatkan data jurusan dan universitas yang dipilih
        $jurusan = Major::find($jurusanId);
        $universitas = University::find($universitasId);

        
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
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
