<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportTransaction extends Model
{
    use HasFactory;

    public static function getHistoryTransactions()
    {
        $mandatory = MandatorySavingDetail::select('mandatory_id as fk_id', 'amount', 'date', 'type', 'description', 'latest_amount', 'mandatory_saving_details.created_by as created_by_user', 'mandatory_saving_details.updated_by as updated_by_user', 'mandatory_saving_details.created_at as created_at', 'mandatory_saving_details.updated_at as updated_at', DB::raw("'Simpanan Wajib' as transaction_type"));
        // ->orderBy('created_at', 'DESC')
                        // ->get();
        $primary =PrimarySavingDetail::select('primary_id as fk_id', 'amount', 'date', 'type', 'description', 'latest_amount', 'primary_saving_details.created_by as created_by_user', 'primary_saving_details.updated_by as updated_by_user', 'primary_saving_details.created_at as created_at', 'primary_saving_details.updated_at as updated_at', DB::raw("'Simpanan Pokok' as transaction_type"));
        // ->orderBy('created_at', 'DESC')
                        // ->get();
        $secondary = SecondarySavingDetail::select('secondary_id as fk_id', 'amount', 'date', 'type', 'description', 'latest_amount', 'secondary_saving_details.created_by as created_by_user', 'secondary_saving_details.updated_by as updated_by_user', 'secondary_saving_details.updated_by as created_at', 'secondary_saving_details.updated_at as updated_at', DB::raw("'Simpanan Sukarela' as transaction_type"));
        // ->orderBy('created_at', 'DESC')
                        // ->get();
        $loan = LoanDetail::select('loan_id as fk_id', 'amount', 'date', 'type', 'description', 'latest_amount', 'loan_details.created_by as created_by_user', 'loan_details.updated_by as updated_by_user', 'loan_details.created_at as created_at', 'loan_details.updated_at as updated_at', DB::raw("'Pinjaman' as transaction_type"));
        // ->orderBy('created_at', 'DESC')
                        // ->get();
        $other = OtherTransaction::select('transaction_categories.name as fk_id', 'amount', 'date', 'type', 'description', DB::raw('NULL as latest_amount'), 'other_transactions.created_by', 'other_transactions.updated_by as updated_by_user', 'other_transactions.created_at as created_at', 'other_transactions.updated_at as updated_at', DB::raw("'Transaksi Lainnya' as transaction_type"))
                        ->leftJoin('transaction_categories', 'transaction_categories.id', '=', 'other_transactions.t_cat_id');

        $allTransaction = $mandatory
            ->union($primary)
            ->union($secondary)
            ->union($loan)
            ->union($other)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $allTransaction;

    }
}
