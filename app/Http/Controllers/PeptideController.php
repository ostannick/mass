<?php

namespace App\Http\Controllers;

use DB;
use App\Peptide;
use Illuminate\Http\Request;

class PeptideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $peptides = DB::table('peptides')->paginate(20);

        return view('mass.peptides', [
          'peptides' => $peptides,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peptide  $peptide
     * @return \Illuminate\Http\Response
     */
    public function show(Peptide $peptide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peptide  $peptide
     * @return \Illuminate\Http\Response
     */
    public function edit(Peptide $peptide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peptide  $peptide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peptide $peptide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peptide  $peptide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peptide $peptide)
    {
        //
    }
}
