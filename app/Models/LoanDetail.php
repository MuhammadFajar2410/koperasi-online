<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'amount',
        'date',
        'type',
        'description',
        'latest_amount',
        'created_by',
        'updated_by'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class,'loan_id');
    }

    //Trnsaksi DB
    public static function getSingleLoanDetail($id)
    {
        return LoanDetail::with('loan')
            ->where('loan_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public static function getmemberLoanDetails($user_id, $id)
    {
        return LoanDetail::with('loan.user.profile')
            ->where('loan_id', $id)
            ->whereHas('loan.user', function ($query) use ($user_id){
                $query->where('id', $user_id);
            })
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public static function getSUMDebit($startDate, $endDate)
    {
        return LoanDetail::where('type', 'd')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
    }

    public static function getSUMCredit($startDate, $endDate)
    {
        return LoanDetail::where('type', 'c')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
    }
}
