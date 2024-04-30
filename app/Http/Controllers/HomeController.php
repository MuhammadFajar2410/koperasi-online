<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use App\Models\OtherTransaction;
use App\Models\PrimarySaving;
use App\Models\PrimarySavingDetail;
use App\Models\SecondarySaving;
use App\Models\SecondarySavingDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = User::getUserLogin(Auth::id());
        $role = Auth::user()->role;

        $start = '2013-01-01';
        $end = Carbon::now()->toDateString();
        $current_amount = (OtherTransaction::getSUMDebit($start, $end) + PrimarySavingDetail::getSUMDebit($start, $end)) + SecondarySavingDetail::getSUMDebit($start, $end) + LoanDetail::getSUMDebit($start, $end) - (OtherTransaction::getSUMCredit($start, $end) + PrimarySavingDetail::getSUMCredit($start, $end) + SecondarySavingDetail::getSUMCredit($start, $end) + LoanDetail::getSUMCredit($start, $end));


        return view('pages.admin.dashboard', compact('user', 'role', 'current_amount'));
    }
}
