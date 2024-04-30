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
        $loans = Loan::getMemberLoan(Auth::id());
        // dd($loans);
        // $profile = PrimarySaving::getSingleMemberPrimarySaving(Auth::id());
        return view('pages.member.loans.index', compact('loans'));
    }

    public function memberShow($id)
    {
        $profile = Loan::getSingleLoan($id);
        $loans = LoanDetail::getmemberLoanDetails(Auth::id(), $id);
        $profiles = User::getAllUserProfile();
        // dd($loans);

        if(!$profile){
            abort(404);
        }
        if(!$loans){
            abort(403);
        }

        return view('pages.member.loans.show', compact('profile', 'loans', 'profiles'));
    }

    public function pLoanIndex()
    {
        $loans = Loan::getLoans();
        // dd($loans);
        $profiles = User::getActiveUser();
        $allProfiles = User::getUsers();
        $loanInstallment = Loan::loanInstallment();
        return view('pages.pengurus.loans.index', compact('loans', 'profiles', 'allProfiles', 'loanInstallment'));
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
            $created_by = Auth::id();
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
                'amount' => $total_amount,
                'date' => $date,
                'type' => 'c',
                'latest_amount' => $total_amount,
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

    public function installment(Request $request)
    {
        $this->validate($request, [
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|min:0|numeric',
        ],[
            'loan_id.exists' => 'Belum ada pinjaman dari anggota ini. Silahkan hubungi admin untuk pengecekan.'
        ]);

        DB::beginTransaction();

        try {

            $data = $request->all();
            $loan = Loan::where('id', $data['loan_id'])->first();
            $created_by = Auth::id();
            $date = Carbon::now()->toDateString();

            // dd($data);

            if($loan){
                $loan_id = $loan->id;
                if($loan->remaining_loan >= $data['amount']){
                    $remaining_loan = $loan->remaining_loan - $data['amount'];
                } else {
                    Session::flash('error','Pinjaman anggota tidak bisa kurang dari 0');
                    return back();
                }
            }

            $loan->update([
                'remaining_loan' => $remaining_loan
            ]);

            LoanDetail::create([
                'loan_id' => $loan_id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'd',
                'description' => $data['description'],
                'latest_amount' => $remaining_loan,
                'created_by' => $created_by
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil membayarkan pinjaman anggota silahkan cek riwayat');
            return redirect()->route('loan.index');
        } catch (\Exception $e) {
            DB::rollback();

            // Session::flash('error', 'Terjadi kesalahan saat melakukan save, silahkan hubungi admin');
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
    public function show($id)
    {
        $loans = LoanDetail::getSingleLoanDetail($id);
        $profile = Loan::getSingleLoan($id);
        $profiles = User::getAllUserProfile();

        if(!$profile){
            abort(404);
        }

        return view('pages.pengurus.loans.show', compact('loans', 'profile', 'profiles'));
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'type' => 'required',
            'description' => 'required|min:3'
        ]);

        DB::beginTransaction();

        try {

            $data = $request->all();
            $data['description'] = ucwords($data['description']);
            $loan = Loan::where('id', $id)->first();
            $created_by = Auth::id();
            $date = Carbon::now()->toDateString();

            // dd($data);

            if($loan){
                $loan_id = $loan->id;
                if($loan->remaining_loan >= $data['amount']){
                    $remaining_loan = $loan->remaining_loan - $data['amount'];
                } else {
                    Session::flash('error','Pinjaman anggota tidak bisa kurang dari 0');
                    return back();
                }
            }

            $loan->update([
                'remaining_loan' => $remaining_loan
            ]);

            LoanDetail::create([
                'loan_id' => $loan_id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => $data['type'],
                'description' => $data['description'],
                'latest_amount' => $remaining_loan,
                'created_by' => $created_by
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil Melakukan Input Transaksi silahkan cek riwayat transaksi');
            return back();
        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('error', $e->getMessage());
            // Session::flash('error', 'Terjadi Kesalahan saat melakukan save data');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
