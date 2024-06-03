<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function primary_detail()
    {
        return $this->hasMany(PrimarySavingDetail::class,'primary_id');
    }

    public static function getPrimarySavings()
    {
        return PrimarySaving::with('user:id', 'user.profile:user_id,name,member_id')->get();
    }

    public static function getPrimaryWithdrawSavings()
    {
        return PrimarySaving::with('user:id', 'user.profile:user_id,name,member_id')
            ->where('amount', '>' , '0')
            ->get();
    }

    public static function getSinglePrimarySaving($id)
    {
        return PrimarySaving::with('user:id', 'user.profile:user_id,name,member_id')
            ->where('id', $id)
            ->first();
    }

    public static function getSingleMemberPrimarySaving($id)
    {
        return PrimarySaving::with('user:id', 'user.profile:user_id,name,member_id')
            ->whereHas('user', function ($query) use ($id){
                $query->where('id', $id);
            })
            ->first();

    }


}
