<?php

namespace App\Http\Controllers;

use App\Models\MandatorySaving;
use App\Models\MandatorySavingDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MandatorySavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savings = MandatorySavingDetail::getMemberSavingDetail(Auth::id());
        $profile = MandatorySaving::getSingleMemberMandatorySaving(Auth::id());
        $profiles = User::getAllUserProfile();

        return view('pages.member.mandatory_savings.index', compact('savings', 'profile', 'profiles'));
    }

    public function pIndexSaving()
    {
        $savings = MandatorySaving::getMandatorySavings();
        $profiles = User::getActiveUser();
        $created_by = User::getAllUserProfile();
        $allProfiles = MandatorySaving::getMandatoryWithdrawSavings();

        return view('pages.pengurus.mandatory_savings.index', compact('savings', 'profiles', 'created_by', 'allProfiles'));
    }

    public function saving(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|min:0|numeric'
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();
            $user_name = Auth::user()->profile->name;
            $created_by = Auth::id();
            $saldo = MandatorySaving::where('user_id', $data['user_id'])->first();
            $date = Carbon::now()->toDateString();

            if ($saldo) {
                $amount = $saldo->amount + $data['amount'];
            } else {
                $amount = $data['amount'];
            }

            if ($saldo) {
                $saldo->update([
                    'amount' => $amount,
                ]);

                $saving_id = $saldo->id;
            } else {
                $secondary_saving = MandatorySaving::create([
                    'user_id' => $data['user_id'],
                    'amount' => $data['amount'],
                    'created_by' => $created_by,
                ]);

                $saving_id = $secondary_saving->id;
            }

            MandatorySavingDetail::create([
                'mandatory_id' => $saving_id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'd',
                'description' => $data['description'],
                'latest_amount' => $amount,
                'created_by' => $created_by
            ]);

            Log::channel('transaction_logs')->info('Mandatory saving successful',
            [
                'mandatory_id' => $saving_id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'd',
                'description' => $data['description'],
                'latest_amount' => $amount,
                'user_name' => $user_name
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil menambahkan tabungan anggota');
            return redirect()->route('mandatory.index');
        } catch (\Exception $e) {
            DB::rollback();

            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Terjadi error saat melakuakan save data, silahkan hubungi admin jika masalah berlanjut');

            return back();
        }

    }

    public function withdraw(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|min:0|numeric'
        ], [
            'user_id.exists' => 'Belum ada tabungan dari anggota ini. Silahkan cek history anggota.'
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();
            $user_name = Auth::user()->profile->name;
            $created_by = Auth::id();
            $saldo = MandatorySaving::where('user_id', $data['user_id'])->first();
            $date = Carbon::now()->toDateString();
            $saving_id = null;
            $amount = 0;

            if ($saldo) {
                $saving_id = $saldo->id;
                if ($saldo->amount >= $data['amount']) {
                    $amount = $saldo->amount - $data['amount'];
                } else {
                    Session::flash('error', 'Saldo tidak mencukupi, jika ada kesalahan silahkan lakukan adjustment terlebih dahulu');
                    return back();
                }
            }

            $saldo->update([
                'amount' => $amount,
            ]);

            MandatorySavingDetail::create([
                'mandatory_id' => $saving_id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'c',
                'description' => $data['description'],
                'latest_amount' => $amount,
                'created_by' => $created_by
            ]);

            Log::channel('transaction_logs')->info('Mandatory withdraw successful', [
                'mandatory_id' => $saving_id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'c',
                'description' => $data['description'],
                'latest_amount' => $amount,
                'user_name' => $user_name
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil melakukan penarikan tabungan anggota');
            return redirect()->route('mandatory.index');
        } catch(\Exception $e) {
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
    public function show($id)
    {
        $savings = MandatorySavingDetail::getSingleMandatorySavingDetail($id);
        $profile = MandatorySaving::getSingleMandatorySaving($id);
        $profiles = User::getAllUserProfile();


        if(!$profile){
            abort(404);
        }

        return view('pages.pengurus.mandatory_savings.show',compact('savings', 'profile', 'profiles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MandatorySaving $mandatorySaving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MandatorySaving $mandatorySaving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MandatorySaving $mandatorySaving)
    {
        //
    }
}
