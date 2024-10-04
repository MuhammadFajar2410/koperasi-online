<?php

namespace App\Http\Controllers;

use App\Models\OtherTransaction;
use App\Models\TransactionCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OtherTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = OtherTransaction::getAllTransactions();
        $categories = TransactionCategory::getActiveCategory();
        $profiles = User::getAllUserProfile();

        return view('pages.admin.others_transactions.index', compact('transactions', 'profiles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            't_cat_id' => 'required|exists:transaction_categories,id',
            'description' => 'required|min:5',
            'amount' => 'required|numeric',
            'date' => 'required'
        ]);

        try {
            $data = $request->all();
            $data['created_by'] = Auth::id();
            $data['description'] = ucwords($data['description']);
            $user_name = Auth::user()->profile->name;

            $trans = OtherTransaction::create($data);

            Log::channel('transaction_logs')->info('Add other transaction successful', [
                'id' => $trans->id,
                't_cat_id' => $trans->t_cat_id,
                'description' => $trans->description,
                'amount' => $trans->amount,
                'type' => $trans->type,
                'date' => $trans->date,
                'user_name' => $user_name
            ]);

            Session::flash('success', 'Berhasil menambahkan transaksi');
            return back();

        } catch (\Exception $e) {
            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Terjadi kesalahan saat melakukan save data');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OtherTransaction $otherTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OtherTransaction $otherTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OtherTransaction $otherTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OtherTransaction $otherTransaction)
    {
        //
    }
}
