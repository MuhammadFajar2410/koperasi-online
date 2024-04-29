<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function pLoanIndex()
    {
        $loans = Loan::getLoans();
        // dd($loans);
        $profiles = User::getActiveUser();
        $allProfiles = User::getUsers();
        return view('pages.pengurus.loans.index', compact('loans', 'profiles', 'allProfiles'));
    }

    public function loan(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|min:0|numeric'
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();
            $created_by = User::getUserLogin(Auth::id())->profile->name;
            $date = Carbon::now()->toDateString();
            $data['period'] = strtoupper($data['period']);
            $total_amount = $data['amount'] + ($data['amount'] * $data['interest'] / 100);
            // dd($data);

            $loan = Loan::create([
                'user_id' => $data['user_id'],
                'loan_type' => 'uang',
                'loan_amount' => $data['amount'],
                'loan_interest' => $data['interest'],
                'total_amount' => $total_amount,
                'remaining_loan' => $total_amount,
                'period' => $data['period'],
                'created_by' => $created_by,
            ]);

            LoanDetail::create([
                'loan_id' => $loan->id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'c',
                'description' => $data['description'],
                'created_by' => $created_by
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil mengajukan pinjaman');
            return redirect()->route('loan.index');
        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('error', 'Terjadi error saat melakukan save, silahkan hubungi admin untuk pengecekan');
            // Session::flash('error', $e->getMessage());
            return back();
        }
    }

    public function installment(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:loans,user_id',
            'amount' => 'required|min:0|numeric',
            'period' => 'required'
        ],[
            'user_id.exists' => 'Belum ada pinjaman dari anggota ini. Silahkan cek history anggota.'
        ]);

        DB::beginTransaction();

        try {

            $data = $request->all();
            $loan = Loan::where('user_id', $data['user_id'])->where('id', $id)->first();
            $created_by = User::getUserLogin(Auth::id())->profile->name;
            $date = Carbon::now()->toDateString();
            $data['period'] = strtoupper($data['period']);

            // dd($data);

            $loan = Loan::create([
                'user_id' => $data['user_id'],
                'loan_type' => 'uang',
                'loan_amount' => $data['amount'],
                'loan_interest' => $data['interest'],
                'total_amount' => $total_amount,
                'remaining_loan' => $total_amount,
                'period' => $data['period'],
                'created_by' => $created_by,
            ]);

            LoanDetail::create([
                'loan_id' => $loan->id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'c',
                'description' => $data['description'],
                'created_by' => $created_by
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil menambahkan tabungan anggota');
            return redirect()->route('loan.index');
        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('error', $e->getMessage());
            return back();
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
