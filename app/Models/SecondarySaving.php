<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondarySaving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'date',
        'type',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function secondary_detail()
    {
        return $this->hasMany(SecondarySavingDetail::class,'secondary_id');
    }

    public static function getSecondarySavings()
    {
        return SecondarySaving::with('user:id', 'user.profile:user_id,name,member_id')->get();
    }

    public static function getSecondaryWithdrawSavings()
    {
        return SecondarySaving::with('user:id', 'user.profile:user_id,name,member_id')
            ->where('amount', '>', '0')
            ->get();
    }

    public static function getSingleSecondarySaving($id)
    {
        return SecondarySaving::with('user:id', 'user.profile:user_id,name,member_id')
            ->where('id', $id)
            ->first();
    }

    public static function getSingleMemberSecondarySaving($id)
    {
        return SecondarySaving::with('user:id', 'user.profile:user_id,name,member_id')
            ->whereHas('user', function ($query) use ($id){
                $query->where('id', $id);
            })
            ->first();

    }
}
