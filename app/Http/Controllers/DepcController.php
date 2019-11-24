<?php

namespace App\Http\Controllers;

use App\Depc;
use Illuminate\Http\Request;

class DepcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mass.depc.depc');
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
      #Remove linebreaks
      $sequence = preg_replace( "/\r|\n/", "", $request->protein_sequence);
      $protease = $request->protease;

      $analysis = shell_exec("py ../python/depc.py $sequence $protease");

      $analysis = json_decode($analysis);

      return view('mass.depc.analyze')->with([
        'analysis' => $analysis
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Depc  $depc
     * @return \Illuminate\Http\Response
     */
    public function show(Depc $depc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Depc  $depc
     * @return \Illuminate\Http\Response
     */
    public function edit(Depc $depc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Depc  $depc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depc $depc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Depc  $depc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depc $depc)
    {
        //
    }
}
