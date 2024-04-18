<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nisn',
        'name',
        'nickname',
        'gender',
        'dob',
        'pob',
        'religion',
        'nationality',
        'siblings_count',
        'daily_language',
        'blood_type',
        'address',
        'phone',
        'residence_type',
        'school_distance',
        'class_id',
        'img',
        'status',
    ];

    public function student_guardian()
    {
        return $this->hasOne(StudentGuardian::class, 'student_id');
    }

    public function student_classroom()
    {
        return $this->hasMany(StudentClassroom::class,'student_id');
    }

    public function student_assessment()
    {
        return $this->hasMany(StudentAssessment::class,'student_id');
    }


    public static function getStudents()
    {
        return StudentProfile::with(['student_guardian:student_id,father_name,mother_name,father_highest_education,mother_highest_education,father_occupation,mother_occupation,student_guardian,relationship,guardian_highest_education,guardian_occupation',
            'student_classroom.classroom:id,class_name,period'])
            ->get();
    }


    public static function getSingleStudent($id)
    {
        return StudentProfile::with('student_guardian:student_id,father_name,mother_name,father_highest_education,mother_highest_education,father_occupation,mother_occupation,student_guardian,relationship,guardian_highest_education,guardian_occupation')
            ->where('id', $id)
            ->first();
    }

    public static function getAllActiveStudent()
    {
        return StudentProfile::with(['student_guardian:student_id,father_name,mother_name,father_highest_education,mother_highest_education,father_occupation,mother_occupation,student_guardian,relationship,guardian_highest_education,guardian_occupation',
            'student_classroom:class_id,student_id'])
            ->where('status','aktif')
            ->get();
    }

    public static function getStudentAssessment($semester)
    {
        return StudentProfile::with(['student_assessment' => function ($query) use ($semester) {
                $query->where('semester', $semester);
            }])
            ->whereHas('student_assessment', function ($query) use ($semester) {
                $query->where('semester', $semester);
            })
            ->get();
    }
}
