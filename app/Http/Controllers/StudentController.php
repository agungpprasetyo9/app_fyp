<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\TryoutMHSChart;
use App\Models\Major;
use App\Models\Recommendation;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use App\Models\Value;
use Google\Service\CloudSourceRepositories\Repo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $tryout;
     private $students;
     private $universiti;
     private $alluniversities;
     private $allmajors;
    
    public function index(Request $request,TryoutMHSChart $TryoutMHSChart)
    {
        //ambil nama
        $Id = Auth::id();
        $getemail = User::where('id', '=', $Id)->select('email')->first();
        $email = $getemail->email;
        $student = Student::where('user_id', '=', $Id)->first();
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
        ->where('values.student_id', $Id)
        ->groupBy('subjects.id')
        ->get();
        // dd($subjects);
        //chart
        $tryout = $TryoutMHSChart->build();
        $students = Student::all();
        $universiti = University::pluck('university_name');
        $alluniversities = University::all();
        $allmajors = Major::all();

        
        return view('student.dashboard',compact(
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

    public function search(Request $request, TryoutMHSChart $tryoutMHSChart)
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
        return view('student.dashboard', compact('tryout', 'name', 'email', 'students', 'universiti', 'alluniversities', 'allmajors', 'majors', 'universities', 'data','subjects'));
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
