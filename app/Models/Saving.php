<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'saving_type',
        'type',
        'amount',
        'description',
        'date',
        'created_by',
        'updated_by'
    ];
}
