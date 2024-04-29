<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondarySavingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'secondary_id',
        'amount',
        'date',
        'type',
        'description',
        'created_by',
        'updated_by'
    ];

    public function secondary_saving()
    {
        return $this->belongsTo(SecondarySaving::class,'secondary_id');
    }

    public static function getSecondarySavingDetail()
    {
        return SecondarySavingDetail::with(['secondary_saving.user.profile'])
            ->orderBy('date', 'DESC')
            ->get();
    }

    public static function getSingleSecondarySavingDetail($id)
    {
        return SecondarySavingDetail::with('secondary_saving:id')
            ->where('secondary_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public static function getMemberSavingDetail($id)
    {
        return SecondarySavingDetail::with('secondary_saving:id', 'secondary_saving.user:id')
            ->whereHas('secondary_saving.user', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();
    }
}
