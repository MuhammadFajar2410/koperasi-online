<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::getAllRole();
        return view('pages.admin.roles.index', compact('roles'));
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
            'name' => 'required|min:3|regex:/^[a-z0-9_\s]+$/'
        ]);

        try {
            $input = $request->all();
            $user_name = Auth::user()->profile->name;

            $input['name'] = str_replace(' ', '_', $request->input('name'));
            Role::create($input);

            Log::channel('transaction_logs')->info('Add new role successful', [
                'new_role' => $input['name'],
                'user_name' => $user_name
            ]);

            Session::flash('success', 'Berhasil membuat role baru');
            return back();

        } catch (\Exception $e){
            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Terjadi kesalahan saat melakukan save data');

            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::getSingleRole($id);

        if (!$role){
            return abort(404);
        }

        return view('pages.admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3|regex:/^[a-z0-9_\s]+$/'
        ]);

        $role = Role::getSingleRole($id);

        if (!$role){
            return abort(404);
        }

        try {
            $old_namne = $role->name;
            $old_status = $role->status;

            $input = $request->all();
            $user_name = Auth::user()->profile->name;

            $input['name'] = str_replace(' ', '_', $request->input('name'));

            $role->update($input);

            Log::channel('transaction_logs')->info('Change role successful', [
                'old_role' => $old_namne,
                'new_role' => $input['name'],
                'old_status' => $old_status,
                'status' => $input['status'],
                'user_name' => $user_name
            ]);

            Session::flash('success', 'Berhasil update role');
            return redirect()->route('role.index');

        } catch (\Exception $e){
            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Terjadi kesalahan saat melakukan save data');
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::getSingleRole($id);

        if(!$role){
            return abort(404);
        }

        $status = $role->delete();
        $old_role = $role->name;
        $user_name = Auth::user()->profile->name;

        if ($status) {

            Log::channel('transaction_logs')->info('Delete role successful', [
                'role' => $old_role,
                'user_name' => $user_name
            ]);

            Session::flash('success', 'Berhasil dihapus');
        } else {
            Session::flash('error', 'Terjadi error ketika melakukan delete');
        }

        return back();

    }
}
