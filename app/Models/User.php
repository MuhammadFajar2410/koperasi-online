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
        'role_id',
        'status',
        'username',
        'email',
        'joinOn',
        'exitOn',
        'reason',
        'password',
        'created_by',
        'updated_by'
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

    // Relasi

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function primary_saving()
    {
        return $this->hasMany(PrimarySaving::class,'user_id');
    }

    public function secondary_saving()
    {
        return $this->hasMany(SecondarySaving::class,'user_id');
    }

    public function loan()
    {
        return $this->hasMany(Loan::class,'user_id');
    }


    // Transaksi DB

    public static function getUserLogin($user_id)
    {
        return User::with('profile:user_id,name')
            ->where('id', $user_id)
            ->first();
    }

    public static function getUserRole($name)
    {
        return User::with('role')
            ->whereHas('role', function ($query) use ($name) {
                $query->where('name', $name);
            })
            ->get();
    }

    public static function getUsers()
    {
        return User::with('role:id,name', 'profile:user_id,name,member_id')->get();
    }

    public static function getAllUserProfile()
    {
        return User::with('profile')->get();
    }

    public static function getActiveUser()
    {
        return User::with('profile:user_id,name')
            ->where('status', true)
            ->get();
    }

}
