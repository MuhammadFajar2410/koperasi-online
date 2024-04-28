<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimarySavingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_id',
        'amount',
        'date',
        'type',
        'created_by',
        'updated_by',
        'description'
    ];

    public function primary_saving()
    {
        return $this->belongsTo(PrimarySaving::class,'primary_id');
    }

    public static function getPrimarySavingDetail()
    {
        return PrimarySavingDetail::with(['primary_saving.user.profile'])
            ->orderBy('date', 'DESC')
            ->get();
    }

    public static function getSinglePrimarySavingDetail($id)
    {
        return PrimarySavingDetail::with('primary_saving:id')
            ->where('primary_id', $id)
            ->orderBy('date', 'DESC')
            ->get();
    }
}
