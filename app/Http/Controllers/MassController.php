<?php

namespace App\Http\Controllers;

use App\Mass;
use Illuminate\Http\Request;

class MassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mass.mass');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      #remove linebreaks
      $sequence = preg_replace( "/\r|\n/", "", $request->protein_sequence );
      $filename = $request->protein_name . time() . '.xlsx';

      #parse the peak list
      $peaks = $request->peaks->storeAs('public/mass_lists/', $filename);

      #shell runs from 'public' directory
      $analysis = shell_exec("python ../python/pepgen.py $request->cutoff_low $request->cutoff_high $request->mass_tolerance $request->charge_state $sequence ../storage/app/public/mass_lists/$filename");
      $analysis = json_decode($analysis);

        return view('mass.analyze')->with([
          'analysis' => $analysis,
          'protein_name' => $request->protein_name,
          'matrix' => $request->matrix
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mass  $mass
     * @return \Illuminate\Http\Response
     */
    public function show(Mass $mass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mass  $mass
     * @return \Illuminate\Http\Response
     */
    public function edit(Mass $mass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mass  $mass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mass $mass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mass  $mass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mass $mass)
    {
        //
    }
}
