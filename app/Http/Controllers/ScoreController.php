<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scores = Score::getAllScore();
        // dd(Score::gradeStandard('76'));
        return view('pages.assessment.score.index',compact('scores'));
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
            'number' => 'required|numeric|between:0,100',
            'max' => 'required|numeric|between:1,100',
            'letter' => 'required|max:3'
        ]);



        try {

            $input = $request->all();

            Score::create($input);

            Session::flash('success','Berhasil menambahkan standar penilaian');

            return redirect()->route('score.index');
        } catch (\Exception $e){
            Session::flash('error',$e->getMessage());
            // Session::flash('error','Terjadi kesalahan saat menyimpan data');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $score = Score::where('id', $id)->first();
        // dd($score);
        return view('pages.assessment.score.edit', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'number' => 'required|numeric|between:0,100',
            'max' => 'required|numeric|between:1,100',
            'letter' => 'required|max:3'
        ]);

        $score = Score::where('id', $id)->first();

        if(!$score){
            abort(404);
        }


        try {
            $input = $request->all();

            $score->update($input);
            Session::flash('success', 'Berhasil update');

            return redirect()->route('score.index');

        } catch (\Exception $e) {
            // Session::flash('error', $e->getMessage());
            Session::flash('error', 'Terjadi kesalahan ketika menyimpan');
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $score = Score::where('id', $id)->first();
        $status = $score->delete();

        if ($status) {
            Session::flash('success', 'Berhasil dihapus');
        } else {
            Session::flash('error', 'Terjadi error ketika melakukan delete');
        }

        return back();

    }
}
