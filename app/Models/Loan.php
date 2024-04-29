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

    //Transaksi DB
    public static function getLoans()
    {
        return Loan::with('user.profile')->get();
    }
}
