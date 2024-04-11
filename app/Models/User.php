<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'status',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public static function getUserLogin($user_id)
    {
        return User::with('profile:user_id,name')->where('id', $user_id)->first();
    }

    public static function getUsers()
    {
        return User::with('profile:user_id,name')->select('id', 'username', 'role', 'status')->get();
    }

    public static function getSingleUser($id)
    {
        return User::where('id', $id)->first();
    }

    public static function roleTeacher()
    {
        return User::with('profile:user_id,name')
            ->select('id', 'username', 'role', 'status')
            ->where('role', 'guru')
            ->orWhere('role', 'kepala_sekolah')
            ->where('status', true)
            ->get();
    }

    public static function getRoleKs()
    {
        return User::with(['profile:user_id,name','teacher:user_id,nip'])
            ->select('id', 'username', 'role', 'status')
            ->where('role', 'kepala_sekolah')
            ->where('status', true)
            ->first();
    }
}
