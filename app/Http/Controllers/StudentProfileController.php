<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Classroom;
use App\Models\StudentAssessment;
use App\Models\StudentClassroom;
use App\Models\StudentGuardian;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addStudent()
    {
        $genders = ['L' => 'Laki-Laki', 'P' => 'Perempuan'];
        $nationalities = ['WNI' => 'WNI', 'WNA' => 'WNA'];
        $blood_type    = ['A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'];
        $classroom = Classroom::class_list();


        return view('pages.students.student_profile.add', compact('genders', 'nationalities', 'blood_type', 'classroom'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function index()
    {
        $classrooms = StudentClassroom::getLatestClassrooms();
        // dd($classrooms);
        $students = StudentProfile::getStudents();
        return view('pages.students.student_profile.index', compact('students', 'classrooms'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'gender' => 'required',
            'address' => 'required',
            'img' => 'image|mimes:jpeg,gif,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $input = $request->all();

            if ($request->hasFile('img')) {
                $img = $request->file("img");
                $imageName = "IMG" . strtoupper(Str::random(10)) . "." . $img->getClientOriginalExtension();
                $img->move('uploads/profile/siswa/', $imageName);
                $input['img'] = $imageName;
            } else {
                $input['img'] = null;
            }

            // dd($input);

            $student = StudentProfile::create([
                'nis' => $input['nis'],
                'nisn' => $input['nisn'],
                'name' => $input['name'],
                'nickname' => $input['nickname'],
                'gender' => $input['gender'],
                'dob' => $input['dob'],
                'pob' => $input['pob'],
                'religion' => $input['religion'],
                'nationality' => $input['nationality'],
                'siblings_count' => $input['siblings_count'],
                'daily_language' => $input['daily_language'],
                'blood_type' => $input['blood_type'],
                'address' => $input['address'],
                'phone' => $input['phone'],
                'residence_type' => $input['residence_type'],
                'school_distance' => $input['school_distance'],
                'img' => $input['img'],
            ]);

            if ($student) {
                StudentGuardian::create([
                    'student_id' => $student->id,
                    'father_name' => $input['father_name'],
                    'mother_name' => $input['mother_name'],
                    'father_highest_education' => $input['father_highest_education'],
                    'mother_highest_education' => $input['mother_highest_education'],
                    'father_occupation' => $input['mother_occupation'],
                    'student_guardian' => $input['student_guardian'],
                    'relationship' => $input['guardian_highest_education'],
                    'guardian_occupation' => $input['guardian_occupation'],
                ]);

                StudentClassroom::create([
                    'student_id' => $student->id,
                    'class_id' => $input['class_id'],
                ]);
            }

            DB::commit();

            Session::flash('success', 'Berhasil Menambahkan Siswa');
            return back();
        } catch (\Exception $e) {

            DB::rollback();

            Session::flash('error', 'Terjadi kesalahan saat upload data: ' . $e->getMessage());
            // Session::flash('error', 'Terjadi kesalahan saat upload data');
            return back();
        }
    }

    public function singleStudent($classroom, $id )
    {
        $student = StudentClassroom::getFinalAssessment($classroom, $id);
        $umum = Assessment::getAssessmentUmum();
        $mulok = Assessment::getAssessmentMulok();
        $spiritual = Assessment::getAssessmentSpiritual();
        $ekskul = Assessment::getAssessmentEkskul();
        $ks = User::getRoleKs();

        // dd($classroom);
        if(!$student){
            abort(404);
        }

        // dd($student);

        $assessments = StudentAssessment::SingleStudentAssessment($classroom, $id);


        return view('pages.students.student_details.hasil-belajar-siswa', compact('student', 'umum', 'mulok', 'spiritual', 'ekskul', 'assessments','ks'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = StudentProfile::getSingleStudent($id);

        if(!$student){
            abort(404);
        }

        return view('pages.students.student_details.detail', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentProfile $studentProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentProfile $studentProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentProfile $studentProfile)
    {
        //
    }
}
