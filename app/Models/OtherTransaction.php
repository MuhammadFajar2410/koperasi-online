<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        't_cat_id',
        'description',
        'amount',
        'type',
        'date',
        'created_by',
        'updated_by'
    ];

    // Relasi

    public function transaction_category()
    {
        return $this->belongsTo(TransactionCategory::class,'t_cat_id');
    }

    // DB Transactions

    public static function getAllTransactions()
    {
        return OtherTransaction::with('transaction_category')
            ->orderByDESC('created_at')
            ->get();
    }

    public static function getSUMDebit($startDate, $endDate)
    {
        return OtherTransaction::where('type', 'd')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
    }

    public static function getSUMCredit($startDate, $endDate)
    {
        return OtherTransaction::where('type', 'c')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
    }

}
