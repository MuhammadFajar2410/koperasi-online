<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_type',
        'loan_amount',
        'loan_interest',
        'total_amount',
        'remaining_loan',
        'period',
        'type',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function loan_detail()
    {
        return $this->hasMany(LoanDetail::class,'loan_id');
    }

    //Transaksi DB
    public static function getLoans()
    {
        return Loan::with('user.profile')->get();
    }

    public static function loanInstallment()
    {
        return Loan::with('user.profile')
            ->where('remaining_loan', '>', 0)
            ->get();
    }

    public static function getSingleLoan($id)
    {
        return Loan::with('user.profile')
            ->where('id', $id)
            ->first();
    }

    public static function getMemberLoanDetail($user_id, $id)
    {
        return Loan::with('loan_detail', 'user.profile')
            ->where('user_id', $user_id)
            ->where('id', $id)
            ->get();
    }

    public static function getMemberLoan($id)
    {
        return Loan::with('loan_detail', 'user.profile')
            ->where('user_id', $id)
            ->get();
    }



}
