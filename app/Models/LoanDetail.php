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
            ->get();
    }

    public static function getMemberLoanDetail($id)
    {
        return LoanDetail::with('loan.user')
            ->whereHas('loan.user', function ($query) use ($id){
                $query->where('id', $id);
            })
            ->get();
    }
}
