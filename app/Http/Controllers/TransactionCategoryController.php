<?php

namespace App\Http\Controllers;

use App\Models\TransactionCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TransactionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TransactionCategory::getAllCategories();
        $profiles = User::getAllUserProfile();
        return view('pages.admin.other_transaction_categories.index', compact('categories', 'profiles'));
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        try {
            $data = $request->all();
            $data['created_by'] = Auth::id();
            $data['name'] = ucwords($data['name']);
            $user_name = Auth::user()->profile->name;

            TransactionCategory::create($data);

            Log::channel('transaction_logs')->info('Add Category successful', [
                'category' => $data['name'],
                'user_name' => $user_name
            ]);

            Session::flash('success', 'Berhasil menambah kategori baru');
            return back();
        } catch (\Exception $e){
            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Terjadi error saat melakukan save data');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionCategory $transactionCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = TransactionCategory::getSingleCategory($id);
        return view('pages.admin.other_transaction_categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3'
        ]);

            $category = TransactionCategory::getSingleCategory($id);

        try {
            $old_name = $category->name;
            $old_status = $category->status;

            $data = $request->all();
            $data['updated_by'] = Auth::id();
            $user_name = Auth::user()->profile->name;


            if(!$category){
                return abort(404);
            }

            $category->update($data);

            Log::channel('transaction_logs')->info('Change category successful', [
                'old_name' => $old_name,
                'new_name' => $data['name'],
                'old_status' => $old_status,
                'new_status' => $data['status'],
                'user_name' => $user_name
            ]);

            Session::flash('success', 'Berhasil merubah kategori transaksi');

            return redirect()->route('other.cat.index');
            // dd($data);
        } catch (\Exception $e){
            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Terjadi kesalahan saat melakukan save');

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = TransactionCategory::getSingleCategory($id);

        if(!$category){
            return abort(404);
        }

        $status = $category->delete();

        $old_cat = $category->name;
        $user_name = Auth::user()->profile->name;

        if($status){
            Log::channel('transaction_logs')->info('Delete role successful', [
                'category' => $old_cat,
                'user_name' => $user_name
            ]);

            Session::flash('success', 'Berhasil Dihapus');
        } else {
            Session::flash('error', 'Terjadi error saat melakukan delete');
        }

        return back();
    }
}
