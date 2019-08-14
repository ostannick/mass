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

    public function analyze(Request $request)
    {
      $dir = "training/";
      $job = \Str::random(8);
      $dataset = Peptide::where('matrix', 'HCCA')->get();

      //CSV File
      $data_file = fopen($dir . 'training_set_' . $job . '.csv', 'w');
      fwrite($data_file, 'Sequence,Ionization,IonBool,');
      fwrite($data_file, "\n");

      foreach($dataset as $peptide){
        $ionBool = "Failed to Ionize";
        if($peptide->abs_ion > 0){
          $ionBool = "Ionizer";
        }
        fwrite($data_file, $peptide->sequence . "," . $peptide->abs_ion . "," . $ionBool);
        fwrite($data_file, "\n");
      }
      fclose($data_file);

      //FASTA File
      $seq_file = fopen($dir . 'query_sequences_' . $job . '.fa', 'w');
      foreach($dataset as $peptide){
        fwrite($seq_file, '>' . $peptide->parent . '_' . $peptide->job);
        fwrite($seq_file, "\n");
        fwrite($seq_file, $peptide->sequence);
        fwrite($seq_file, "\n");
      }


    }

}
