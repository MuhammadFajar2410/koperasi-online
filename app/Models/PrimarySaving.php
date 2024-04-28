<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimarySaving extends Model
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
}
