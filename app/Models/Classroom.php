<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_name',
        'grade',
        'period'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function student_classroom()
    {
        return $this->hasMany(StudentClassroom::class,'class_id');
    }

    public static function class_list()
    {
        // return Classroom::with('teacher:id,name')->get();

        return Classroom::with('teacher.user.profile')->orderBy('period', 'desc')->get();
    }

    public static function getSingleClass($id)
    {
        return Classroom::where('id', $id)->first();
    }

    public static function changeClassList($grade)
    {
        return Classroom::where('grade', $grade)->get();
    }

    public static function classroomList()
    {
        return Classroom::with(['teacher.user.profile:id,user_id,name', 'teacher'])
        ->whereHas('teacher', function ($query) {
                $query->where('is_homeroom', true);
            })
            ->orWhereDoesntHave('teacher')
            ->orderBy('period', 'desc' )
            ->orderBy('class_name', 'asc' )
            ->get();
    }

    public static function classList()
    {
        return Classroom::get();
    }


}
