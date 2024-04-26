<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = User::getUserLogin(Auth::id());
        $role = Auth::user()->role;
        return view('pages.admin.dashboard', compact('user', 'role'));
    }
}
