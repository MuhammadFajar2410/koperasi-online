<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_id',
        'name',
        'nik',
        'address',
        'gender',
        'job',
        'phone',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getAllProfiles()
    {
        return Profile::with('user:id,status,exitOn,joinOn,reason')->get();
    }
}
