<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_id',
        'saving_id',
        'amount',
        'loan_collection',
        'date',
        'created_by',
        'updated_by',
    ];
}
