<?php

namespace App\Http\Controllers;

use App\Mass;
use App\Peptide;
use App\LonelyPeptide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
      #Create job directory for this submission
      $job = Str::random(16);
      mkdir('../storage/app/public/pmf_jobs/' . $job);
      $job_directory = '../storage/app/public/pmf_jobs/' . $job . '/';

      #Remove linebreaks
      $sequence = preg_replace( "/\r|\n/", "", $request->protein_sequence);
      $filename = $request->protein_name . time() . '.xlsx';
      $datapath = $job_directory . $filename;

      #Parse the peak list
      $peaks = $request->peaks->storeAs('public/pmf_jobs/' . $job, $filename);

      #Shell runs from 'public' directory
      $analysis = shell_exec("py ../python/pepgen.py $request->cutoff_low $request->cutoff_high $request->mass_tolerance $request->charge_state $sequence $datapath $job_directory");

      $analysis = json_decode($analysis);

      if($request->skipDB == '1')
      {
        foreach($analysis->peptides as $peptide) {
          if($peptide->visibility == False)
          {
            continue;
          }
          #Skip for any pre-existing peptide that has been done under a specific matrix before
          if(Peptide::where('sequence', $peptide->sequence)->where('matrix', $request->matrix)->exists())
          {
            continue;
          }

          $pep = new Peptide;
          $pep->job = $job;
          $pep->calc_mass = $peptide->mass;
          $pep->sequence = $peptide->sequence;
          $pep->rel_ion = $peptide->fracIon;
          $pep->abs_ion = $peptide->absIon;
          $pep->matrix = $request->matrix;
          $pep->parent = $request->protein_name;
          $pep->save();
        }

        foreach($analysis->massList as $lp)
        {
          $pep = new LonelyPeptide;
          $pep->job = $job;
          $pep->exp_mass = $lp->mass;
          $pep->rel_ion = $lp->fracIon;
          $pep->abs_ion = $lp->absIon;
          $pep->matrix = $request->matrix;
          $pep->save();
        }
      }



        return view('mass.analyze')->with([
          'analysis' => $analysis,
          'protein_name' => $request->protein_name,
          'matrix' => $request->matrix,
          'job' => $job
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
