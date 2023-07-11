<?php

namespace App\Http\Controllers;

use App\Charts\SubjectValueChart;
use App\Charts\TryoutAVGChart;
use App\Models\Alumni;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use App\Models\Major;
use App\Models\Recommendation;
use App\Models\Value;
use App\Charts\TryoutMHSChart;
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
        $rekomen = [];
        $rekomendasi = DB::table('values')
        ->join('subjects', 'values.subject_id', '=', 'subjects.id')
        ->select('subjects.subject_name', DB::raw('ROUND(AVG(values.value)) AS average_score'))
        ->groupBy('subjects.subject_name')
        ->orderBy('average_score', 'ASC')
        ->get();
        $subjectNames = $rekomendasi->pluck('subject_name')->toArray();
        // dd($subjectNames);
        $tryoutAVG = $tryoutAVGChart->build();
        $subjectValue = $subjectValueChart->build();
        // Mengambil jumlah student
        $result = DB::table('alumnis')
            ->selectRaw('COUNT(*) AS total_siswa')
            ->selectRaw('ROUND((COUNT(CASE WHEN acceptance = "Lulus" THEN 1 END) / COUNT(*)) * 100) AS persentase_lulus')
            ->first();
        $percentage = $result->persentase_lulus;
        $studentCount = Student::count();
        $alumni = Alumni::count();
        return view('admin.dashboard', compact('studentCount','tryoutAVG','subjectValue','percentage','alumni','subjectNames')); 
        // return "test bang"; 
    }
    public function detail($id,Request $request,TryoutMHSChart $TryoutMHSChart)
    {
        //ambil nama
        // $id = Auth::id();
        $getemail = User::where('id', '=', $id)->select('email')->first();
        $email = $getemail->email;
        $student = Student::where('user_id', '=', $id)->first();
        if ($student) {
            $name = $student->name;
        } else {
            // Student dengan user_id = 1 tidak ditemukan
            $name = null;
        }
        //recommendation
        //barchart subjects
        $subjects = DB::table('values')
        ->join('subjects', 'values.subject_id', '=', 'subjects.id')
        ->select('subjects.subject_name', DB::raw('ROUND(AVG(values.value)) AS nilai'))
        ->where('values.student_id', $id)
        ->groupBy('subjects.id')
        ->get();
        // dd($subjects);
        //chart
        $tryout = $TryoutMHSChart->build();
        $students = Student::all();
        $universiti = University::pluck('university_name');
        $alluniversities = University::all();
        $allmajors = Major::all();

        
        return view('admin.detail',compact(
            'tryout', 
            'name',
            'email',
            'students',
            'universiti',
            'alluniversities',
            'allmajors',
            'subjects'
        ));
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

    // public function detail($id){

    //     $students = DB::table('students')
    //         ->where('id', '=', $id)
    //         ->first();

    //     return view('admin.detail', compact('students'));
    // }

    public function alumni(){

        $alumnis = DB::table('alumnis')
            ->get();

        return view('admin.alumni', compact('alumnis'));
    }
    public function search($id,Request $request, TryoutMHSChart $tryoutMHSChart)
    {
        
        $Id = Auth::id();
        $jurusan = $request->input('jurusan');
        $universitas = $request->input('universitas');
        // dd($universitas);
        $data = [];
        // Mendapatkan skor siswa berdasarkan nilai rata-rata tryout
        $score = Value::where('student_id', $Id)
        ->selectRaw('ROUND(AVG(value)) AS average_value')
        ->value('average_value');

        // Filter berdasarkan pilihan pengguna
        if ($universitas) {
            // $selectedUniversity = Recommendation::find($universitas);
            // $selectedUniversity = Recommendation::where('university_id', $universitas)->get();
            $selectedUniversity = Recommendation::with('majors')->where('university_id', $universitas)->first();

            $universityId = $selectedUniversity->university_id;
            // Mengambil semua jurusan dari universitas yang dipilih
            $majors = DB::table('majors as m')
            ->select('m.major_name', 'm.tightness')
            ->distinct()
            ->join('recommendations as r', 'm.id', '=', 'r.major_id')
            ->where('r.university_id', $selectedUniversity->university_id)
            ->get();
            $universityName = DB::table('universities')->pluck('university_name');
            // dd($universityName);
            $universityTightness = DB::table('universities')
            ->select(DB::raw('tightness'))
            ->where('id', $selectedUniversity->university_id)
            ->first();
            // $tightness = $universityTightness->tightness;
            // dd($universityTightness);
            // Perulangan untuk menghitung nilai kecocokan dan mengisi data rekomendasi
            foreach ($majors as $major) {
                //ambil keketatan
                $strictnessMajor = intval($major->tightness*10);
                // $strictnessUniversity = intval($universityTightness);
                $strictnessUniversity = intval($universityTightness->tightness*10);

                // Menghitung nilai kecocointval(kan berdasarkan skor, keketatan jurusan, dan keketatan universitas
                $nilaiKecocokan = $score * $strictnessMajor * $strictnessUniversity;

                // Menambahkan data rekomendasi ke dalam array
                $data[] = [
                    'name' => $major->major_name,
                    'score' => intval($nilaiKecocokan),
                    'ut' => $strictnessUniversity,
                    'mt' => $strictnessMajor,
                ];
            }
        } elseif ($jurusan) {
            // $selectedMajor = Major::find($jurusan);
            // $selectedMajor = Recommendation::where('major_id', $jurusan)->get();
            $selectedMajor = Recommendation::with('universities')->where('major_id', $jurusan)->first();

            $majorId = $selectedMajor->major_id;
            // Mengambil semua jurusan dari universitas yang dipilih
            $universities = DB::table('universities as u')
            ->select('u.university_name', 'u.tightness')
            ->distinct()
            ->join('recommendations as r', 'u.id', '=', 'r.university_id')
            ->where('r.major_id', $selectedMajor->major_id)
            ->get();
            $majorName = DB::table('majors')->pluck('major_name');
            // dd($universityName);
            $majorTightness = DB::table('majors')
            ->select(DB::raw('tightness'))
            ->where('id', $selectedMajor->major_id)
            ->first();
            // $tightness = $universityTightness->tightness;
            // dd($universityTightness);
            // Perulangan untuk menghitung nilai kecocokan dan mengisi data rekomendasi
            foreach ($universities as $university) {
                //ambil keketatan$university
                $strictnessMajor = intval($majorTightness->tightness*10);
                // $strictnessUniversity = intval($universityTightness);
                $strictnessUniversity = intval($university->tightness*10);

                // Menghitung nilai kecocointval(kan berdasarkan skor, keketatan jurusan, dan keketatan universitas
                $nilaiKecocokan = $score * $strictnessMajor * $strictnessUniversity;

                // Menambahkan data rekomendasi ke dalam array
                $data[] = [
                    'name' => $university->university_name,
                    'score' => intval($nilaiKecocokan),
                    'ut' => $strictnessUniversity,
                    'mt' => $strictnessMajor,
                ];
            }
        }
        // dd($data);
        $majors = Major::all()->toArray();
        $universities = University::all()->toArray();
        $Id = Auth::id();

        $subjects = DB::table('values')
        ->join('subjects', 'values.subject_id', '=', 'subjects.id')
        ->select('subjects.subject_name', DB::raw('ROUND(AVG(values.value)) AS nilai'))
        ->where('values.student_id', $Id)
        ->groupBy('subjects.id')
        ->get();

        $getemail = User::where('id', '=', $Id)->select('email')->first();
        $email = $getemail->email;
        $student = Student::where('id', '=', $Id)->first();
        $getemail = User::where('id', '=', $Id)->select('email')->first();
        $email = $getemail->email;
        $student = Student::where('id', '=', $Id)->first();
        
        if ($student) {
            $name = $student->name;
        } else {
            // Student dengan user_id = 1 tidak ditemukan
            $name = null;
        }
        //chart
        $tryout = $tryoutMHSChart->build();
        $students = Student::all();
        $universiti = University::pluck('university_name');
        $alluniversities = University::all();
        $allmajors = Major::all();
        // dd($data);
        // Mengembalikan hasil rekomendasi dalam bentuk array data
        return view('admin.detail', compact('tryout', 'name', 'email', 'students', 'universiti', 'alluniversities', 'allmajors', 'majors', 'universities', 'data','subjects'));
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
