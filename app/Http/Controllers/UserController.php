<?php

namespace App\Http\Controllers;

use App\Models\PrimarySaving;
use App\Models\PrimarySavingDetail;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Saving;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::getUsers();
        // dd($users);
        // $roles = Role::getActiveRole();
        return view('pages.admin.users.index', compact('users'));
    }

    public function addUser()
    {
        $roles = Role::getActiveRole();
        $genders = ['l' => 'Laki-Laki', 'p' => 'Perempuan'];
        return view('pages.admin.users.add', compact('roles', 'genders'));
    }

    public function adminAddUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'address' => 'required',
            'member_id' => 'numeric|min_digits:7|unique:profiles,member_id',
            'amount' => 'numeric',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed'
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['created_by'] = Auth::id();
            $user_name = Auth::user()->profile->name;

            // dd($data);
            $user = User::create([
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'created_by' => $data['created_by'],
                'role_id' => $data['role_id'],
                'joinOn' => $data['joinOn']
            ]);

            if ($user) {
                $profile = Profile::create([
                    'user_id' => $user->id,
                    'member_id' =>$data['member_id'],
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'gender' => $data['gender'],
                    'job' => $data['job'],
                    'created_by' => $data['created_by'],
                ]);

                $primary = PrimarySaving::create([
                    'user_id' => $user->id,
                    'amount' => $data['amount'],
                    'created_by' => $data['created_by'],
                ]);

                PrimarySavingDetail::create([
                    'primary_id' => $primary->id,
                    'amount' => $data['amount'],
                    'date' => $data['joinOn'],
                    'type' => 'd',
                    'latest_amount' => $data['amount'],
                    'created_by' => $data['created_by'],
                ]);

            }

            Log::channel('transaction_logs')->info('Add new member successful', [
                'username' => $user->username,
                'role_id' => $user->role_id,
                'name' => $profile->name,
                'primary' => $primary->id,
                'primary_amount' => $primary->amount,
                'user_name' => $user_name
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil menambahkan user');
            return back();
        } catch (\Exception $e) {

            DB::rollback();

            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Error saat melakukan input data');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::getSingleUser($id);
        $roles = Role::getActiveRole();
        return view('pages.admin.users.edit', compact('user', 'roles'));
    }

    public function myProfile()
    {
        $user = User::getSingleUser(Auth::id());

        return view('pages.member.profiles.my_account', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function changePasswordAdmin(Request $request, $id)
    {

        $this->validate($request, [
            'username' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed'
        ]);

            $user = User::findOrFail($id);

        try {
            $old_user = $user->username;

            $data = $request->all();
            $user_name = Auth::user()->profile->name;


            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }



            $user->update([
                'username' => $data['username'],
                'password' => $data['password'] ?? $user->password,
                'updated_by' => Auth::id()
            ]);

            // dd($data['password']);

            Log::channel('transaction_logs')->info('Change username or password successful', [
                'old_username' => $old_user,
                'new_username' => $data['username'],
                'password' => $request->filled('password') ? 'Password changed' : 'Password not changed',
                'user_name' => $user_name
            ]);


            Session::flash('success', 'Berhasil mengubah data pengguna');
            return redirect()->route('user.index');

        } catch (\Exception $e) {

            Session::flash('error', 'Kesalahan ketika mengirim data');
            return back();
        }
    }


    public function changePasswordMember(Request $request, $id)
    {

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);


        $user = User::getSingleUser($id);

        try {
            $data = $request->all();

            $my_pass = Auth::user()->password;
            $old_pass = $data['current_password'];
            $new_pass = $data['password'];
            $user_name =  Auth::user()->profile->name;

            if (password_verify($old_pass, $my_pass)) {
                $data['password'] = Hash::make($new_pass);
                $user->update([
                    'password' => $data['password']
                ]);

                Log::channel('transaction_logs')->info('Change password successful', [
                    'user_name' => $user_name
                ]);

                Session::flash('success', 'Berhasil mengganti password');
                return redirect()->route('home');
            } else {
                Session::flash('error', 'Password lama salah, silahkan hubungi admin jika lupa password');
                return back();
            }
        } catch (\Exception $e) {

            Session::flash('error', 'Kesalahan ketika mengirim data');
            return back();
        }
    }

    public function changeProfileAdmin(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::getSingleUser($id);
        $profile = Profile::where('user_id', $id);

            DB::beginTransaction();
        try {
            $data = $request->all();
            $user_name = Auth::user()->profile->name;

            $user->update([
                'role_id' => $data['role_id'],
                'exitOn' => $data['exitOn'],
                'reason' => $data['reason'],
                'status' => $data['status'],
            ]);

            $profile->update([
                'member_id' => $data['member_id'],
                'name' => $data['name'],
                'address' => $data['address'],
                'gender' => $data['gender'],
                'job' => $data['job'],
            ]);

            Log::channel('transaction_logs')->info('Change profile successful', [
                'user_name' => $user_name
            ]);

            DB::commit();

            Session::flash('success', 'Berhasil merubah ');
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollback();

             Session::flash('error',$e->getMessage());
            //  Session::flash('error', 'Kesalahan ketika mengirim data');
             return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::getSingleUser($id);
        $status = $user->delete();

        if ($status) {
            Session::flash('success', 'User berhasil dihapus');
        } else {
            Session::flash('error', 'Terjadi error ketika melakukan delete');
        }

        return back();
    }
}
