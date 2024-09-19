<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MandatorySavingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'mandatory_id',
        'amount',
        'date',
        'type',
        'latest_amount',
        'created_by',
        'updated_by',
        'description'
    ];

    public function mandatory()
    {
        return $this->belongsTo(MandatorySaving::class,'mandatory_id');
    }

    //DB Transactions

    public static function getMandatorySavingsDetail()
    {
        return MandatorySavingDetail::with('mandatory.user.profile')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public static function getSingleMandatorySavingDetail($id)
    {
        return MandatorySavingDetail::with('mandatory')
            ->where('mandatory_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public static function getMemberSavingDetail($id)
    {
        return MandatorySavingDetail::with('mandatory.user')
            ->whereHas('mandatory.user', function ($query) use ($id){
                $query->where('id', $id);
            })
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public static function getSUMDebit($startDate, $endDate)
    {
        return MandatorySavingDetail::where('type', 'd')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
    }

    public static function getSUMCredit($startDate, $endDate)
    {
        return MandatorySavingDetail::where('type', 'c')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
    }
}
