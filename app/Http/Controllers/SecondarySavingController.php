<?php

namespace App\Http\Controllers;

use App\Models\PrimarySaving;
use App\Models\SecondarySaving;
use App\Models\SecondarySavingDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SecondarySavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savings = SecondarySavingDetail::getMemberSavingDetail(Auth::id());
        $profile = SecondarySaving::getSingleMemberSecondarySaving(Auth::id());

        return view('pages.member.secondary_savings.index', compact('savings', 'profile'));
    }

    public function pIndexSaving()
    {
        $savings = SecondarySaving::getSecondarySavings();
        $profiles = User::getActiveUser();
        $allProfiles = SecondarySaving::getSecondaryWithdrawSavings();

        return view('pages.pengurus.secondary_savings.index', compact('savings', 'profiles', 'allProfiles'));
    }

    public function saving(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|min:0|numeric'
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();
            $created_by = User::getUserLogin(Auth::id())->profile->name;
            $saldo = SecondarySaving::where('user_id', $data['user_id'])->first();
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
                $secondary_saving = SecondarySaving::create([
                    'user_id' => $data['user_id'],
                    'amount' => $data['amount'],
                    'created_by' => $created_by,
                ]);

                $saving_id = $secondary_saving->id;
            }

            SecondarySavingDetail::create([
                'secondary_id' => $saving_id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'd',
                'description' => $data['description'],
                'latest_amount' => $amount,
                'created_by' => $created_by
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil menambahkan tabungan anggota');
            return redirect()->route('secondary.index');
        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('error', $e->getMessage());
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
            $created_by = User::getUserLogin(Auth::id())->profile->name;
            $saldo = SecondarySaving::where('user_id', $data['user_id'])->first();
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

            SecondarySavingDetail::create([
                'secondary_id' => $saving_id,
                'amount' => $data['amount'],
                'date' => $date,
                'type' => 'c',
                'description' => $data['description'],
                'latest_amount' => $amount,
                'created_by' => $created_by
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil melakukan penarikan tabungan anggota');
            return redirect()->route('secondary.index');
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
        $savings = SecondarySavingDetail::getSingleSecondarySavingDetail($id);
        $profile = SecondarySaving::getSingleSecondarySaving($id);
        // dd($profile);

        if(!$profile){
            abort(404);
        }


        return view('pages.pengurus.secondary_savings.show', compact('savings', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SecondarySaving $secondarySaving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SecondarySaving $secondarySaving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SecondarySaving $secondarySaving)
    {
        //
    }
}
