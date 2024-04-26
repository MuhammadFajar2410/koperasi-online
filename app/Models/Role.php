<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public static function getAllRole()
    {
        return Role::get();
    }

    public static function getActiveRole()
    {
        return Role::where('status', true)->get();
    }

    public static function getSingleRole($id)
    {
        return Role::where('id', $id)->first();
    }
}
