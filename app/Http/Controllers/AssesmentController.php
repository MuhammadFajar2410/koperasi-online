<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssesmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assessment = Assessment::getAllAssessment();
        $type = [
            'umum' => 'Umum',
            'mulok' => 'Muatan Lokal',
            'spiritual' => 'Pengembangan Sikap Spiritual & Sosial',
            'ekskul' => 'Pengembangan Diri (Ekstrakulikuler)'
        ];
        return view('pages.assessment.index', compact('type', 'assessment' ));
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
            'type' => 'required',
            'name' => 'required',
            'minimum' => 'nullable|numeric|between:1,100'
        ]);

        try {

            $input = $request->all();
            // dd($input);
            Assessment::create($input);

            return redirect()->route('assessment.index');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            // Session::flash('error', 'Terjadi kesalahan saat menyimpan data');
            return back();
        }


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $assessment = Assessment::getSingleAssessment($id);
        $types = [
            'umum' => 'Umum',
            'mulok' => 'Muatan Lokal',
            'spiritual' => 'Pengembangan Sikap Spiritual & Sosial',
            'ekskul' => 'Pengembangan Diri (Ekstrakulikuler)'
        ];
        return view('pages.assessment.edit', compact('assessment', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'type' => 'required',
            'name' => 'required',
            'minimum' => 'required|numeric|between:1,100'
        ]);

        $assesment = Assessment::getSingleAssessment($id);

        try {

            $input = $request->all();
            $assesment->update($input);

            Session::flash('success', 'Berhasil update data');

            return redirect()->route('assessment.index');
        } catch (\Exception $e) {
            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Terjadi kesalahan saat menyimpan data');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assessment = Assessment::where('id', $id)->first();
        $status = $assessment->delete();

        if ($status) {
            Session::flash('success', 'Berhasil dihapus');
        } else {
            Session::flash('error', 'Terjadi error ketika melakukan delete');
        }

        return back();
    }
}
