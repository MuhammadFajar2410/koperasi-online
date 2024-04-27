<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login_form()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status) {
                $request->session()->regenerate();
                Session::flash('success', 'Successfully Login');
                return redirect()->route('home');
            } else {
                Auth::logout(); // Logout user jika statusnya tidak aktif
                Session::flash('error', 'Akun anda Non Aktif silahkan hubungi admin');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Invalid username and password pleas try again!');
            return redirect()->back();
        }
    }



    public function register_form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required|min:2',
            'username' => 'string|required|unique:users,username',
            'password' => 'required|min:6|confirmed'
        ]);

        try {

            $data = $request->all();
            $data['created_by'] = 'MJR';
            $data['gender'] = 'l';
            // dd($data);
            DB::beginTransaction();

            $user = User::create([
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'created_by' => $data['created_by'],

            ]);

            if ($user) {
                Profile::create([
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'created_by' => $data['created_by'],
                    'gender' => $data['gender']
                ]);
            }

            DB::commit();

            Session::flash('success', 'Register Berhasil Silahkan Login');
            return redirect()->route('login-page');
        } catch (\Exception $e) {

            DB::rollback();
            Session::flash('error', $e->getMessage());
            // Session::flash('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
            return back();
        }
    }

    // public function register(Request $request)
    // {
    //     $this->validate($request,[
    //         'name' => 'string|required|min:3',
    //         'username' => 'required|unique:users,username',
    //         'password' => 'required|confirmed'
    //     ]);

    //     try{
    //         $input = $request->all();

    //         User::create($input);
    //         Session::flash('success', 'Berhasil register silahkan login');

    //         return redirect()->route('login-page');
    //     } catch (\Exception $e){
    //         Session::flash('error', $e->getMessage());
    //         return back();
    //     }
    // }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('login-page');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
