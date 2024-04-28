<?php

namespace App\Http\Controllers;

use App\Models\SecondarySaving;
use Illuminate\Http\Request;

class SecondarySavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savings = SecondarySaving::getSecondarySavings();
        return view('pages.pengurus.secondary_saving.index', compact('savings'));
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
    public function show(SecondarySaving $secondarySaving)
    {
        //
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
