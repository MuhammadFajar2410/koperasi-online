<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by'
    ];

    // Relation
    public function other_transaction()
    {
        return $this->hasMany(OtherTransaction::class,'t_cat_id');
    }


    // DB Transactions
    public static function getAllCategories()
    {
        return TransactionCategory::get();
    }

    public static function getSingleCategory($id)
    {
        return TransactionCategory::where('id', $id)->first();
    }

    public static function getActiveCategory()
    {
        return TransactionCategory::where('status', true)->get();
    }
}
