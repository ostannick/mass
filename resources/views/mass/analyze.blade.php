@extends('layouts.app')

@section('content')

    <h1 class="ui teal">{{$protein_name}} (Job ID: {{$job}})</h1>
    <h5>{{\Carbon\Carbon::now()->toDayDateTimeString()}}</h2>

    <div class="ui divider"></div>

    <h3>Peptide Ion Coverage</h3>

    <div class="ui orange progress" data-percent="{{$analysis->matchCount / $analysis->possibleObserved * 100}}">
      <div class="bar"></div>
      <div class="label">{{number_format($analysis->matchCount / $analysis->possibleObserved * 100, 2)}}% Ion Coverage ({{$analysis->matchCount}} of {{$analysis->possibleObserved}} found)</div>
    </div>

    <h3>Protein Sequence Coverage</h3>

    <div class="ui teal progress" data-percent="{{number_format($analysis->coverage, 2)}}">
      <div class="bar"></div>
      <div class="label">{{number_format($analysis->coverage, 2)}}% Sequence Coverage</div>
    </div>

    <div class="ui huge stacked segment monospace protein-sequence">
      <p>
        @foreach($analysis->peptides as $peptide)<span @if($peptide->observed)class="highlighted" @endif>{{$peptide->sequence}}</span>@endforeach
      </p>
    </div>

    <div class="ui divider"></div>

    <h3>Statistics & Metrics</h3>
    <div class="ui two column grid">
      <div class="column">
        <div class="ui segment">
          <img class="ui fluid image" src="{{asset('storage/pmf_jobs/' . $job . '/stems.png')}}" alt="">
        </div>
      </div>
      <div class="column">
        <div class="ui segment">
          <img class="ui fluid image" src="{{asset('storage/pmf_jobs/' . $job . '/tolerances.png')}}" alt="">
        </div>
      </div>
    </div>



    <div class="ui divider"></div>

    <h3>Peptide Analysis - <span style="font-style: italic">in silico</span> Digest</h5>
    <table class="ui celled table">
    <thead>
      <tr>
        <th>Peptide Sequence</th>
        <th>Mass</th>
        <th>Ionization Propensity (Rel.)</th>
        <th>Ionization Propensity (Abs.)</th>
        <th>Match</th>
      </tr>
    </thead>
    <tbody class="monospace">
      @foreach($analysis->peptides as $peptide)
        @if($peptide->visibility)
          @if($peptide->observed)
          <tr class="positive">
            <td>{{$peptide->sequence}}</td>
            <td>{{$peptide->mass}}</td>
            <td>{{$peptide->fracIon}}</td>
            <td>{{$peptide->absIon}}</td>
            <td><i class="icon checkmark"></i></td>
          </tr>
          @else
          <tr class="negative">
            <td class="monospace">{{$peptide->sequence}}</td>
            <td>{{$peptide->mass}}</td>
            <td>0.00</td>
            <td>0</td>
            <td><i class="icon delete"></i></td>
          </tr>
          @endif
        @endif
      @endforeach
    </tbody>
  </table>

  <div class="ui divider"></div>
  <h3>Experimentally Observed Peptides with No Match</h3>
  <table class="ui celled table">
  <thead>
    <tr>
      <th>Mass</th>
      <th>Ionization Propensity (Rel.)</th>
      <th>Ionization Propensity (Abs.)</th>
      <th>Suspect</th>
    </tr>
  </thead>
  <tbody class="monospace">
    @foreach($analysis->massList as $mass)
      @if($mass->hasMatch == false)
        <tr>
          <td>{{$mass->mass}}</td>
          <td>{{$mass->fracIon}}</td>
          <td>{{$mass->absIon}}</td>
          <td>N/A</td>
        </tr>
      @endif
    @endforeach
  </tbody>
</table>

<div class="ui divider"></div>

<div class="ui message">
  <div class="header">Notes:</div>
  <ul class="list">
    <li>This job will not be saved. Print your results now, or you will need to re-submit your data to view your analysis after leaving this page.</li>
  </ul>
</div>
@endsection
