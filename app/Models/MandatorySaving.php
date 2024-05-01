<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MandatorySaving extends Model
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mandatory_detail()
    {
        return $this->hasMany(MandatorySavingDetail::class,'mandatory_id');
    }

    //DB Transactions

    public static function getMandatorySavings()
    {
        return MandatorySaving::with('user.profile')->get();
    }

    public static function getSingleMandatorySaving($id)
    {
        return MandatorySaving::with('user.profile')
            ->where('id', $id)
            ->first();
    }

    public static function getMandatoryWithdrawSavings()
    {
        return MandatorySaving::with('user.profile')
            ->where('amount', '>','0')
            ->get();
    }

    public static function getSingleMemberMandatorySaving($id)
    {
        return MandatorySaving::with('user.profile')
            ->whereHas('user', function ($query) use ($id){
                $query->where('id', $id);
            })
            ->first();
    }

}
