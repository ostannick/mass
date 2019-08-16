<?php

namespace App\Http\Controllers;

use App\Prosecco;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProseccoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nmr.prosecco');
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
      #Create job directory for this submission
      $job = Str::random(16);
      mkdir("../storage/app/public/prosecco_jobs/$job");
      $job_directory = '../storage/app/public/prosecco_jobs/' . $job . '/';

      #Define file names
      $protein = $request->protein_name;
      $filename = $request->protein_name . time() . '.xlsx';

      $datapath = $job_directory . $filename;

      #Save the peak list
      $shifts = $request->cs->storeAs('public/prosecco_jobs/' . $job, $filename);

      #Shell runs from 'public' directory
      $analysis = shell_exec("py ../python/prosecco_graphical_v2.py $datapath $job_directory");

      //Add low hanging fruit script
      //Add script for visualizing out-of-the-ordinary chemical shifts

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prosecco  $prosecco
     * @return \Illuminate\Http\Response
     */
    public function show(Prosecco $prosecco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prosecco  $prosecco
     * @return \Illuminate\Http\Response
     */
    public function edit(Prosecco $prosecco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prosecco  $prosecco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prosecco $prosecco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prosecco  $prosecco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prosecco $prosecco)
    {
        //
    }
}
