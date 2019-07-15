@extends('layouts.app')

@section('content')

      <h1>{{$protein_name}}</h1>
      <h5>{{\Carbon\Carbon::now()}}</h2>

    <div class="ui divider"></div>

    <h3>Protein Sequence Coverage</h3>

    <div class="ui teal progress" data-percent="{{number_format($analysis->coverage, 2)}}" id="example1">
      <div class="bar"></div>
      <div class="label">{{number_format($analysis->coverage, 2)}}% Coverage</div>
    </div>

    <div class="ui huge stacked segment monospace protein-sequence">
      <p>
        @foreach($analysis->peptides as $peptide)<span @if($peptide->observed)class="highlighted" @endif>{{$peptide->sequence}}</span>@endforeach
      </p>
    </div>

    <div class="ui divider"></div>

    <h3>Peptide Analysis - <span style="font-style: italic">in silico</span> Digest</h5>
    <table class="ui celled table">
    <thead>
      <tr>
        <th>Peptide Sequence</th>
        <th>Mass</th>
        <th>Ionization Propensity</th>
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
            <td><i class="icon checkmark"></i></td>
          </tr>
          @else
          <tr class="negative">
            <td class="monospace">{{$peptide->sequence}}</td>
            <td>{{$peptide->mass}}</td>
            <td>0.00</td>
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
      <th>Ionization Propensity</th>
      <th>Suspect</th>
    </tr>
  </thead>
  <tbody class="monospace">
    @foreach($analysis->massList as $mass)
      @if($mass->hasMatch == false)
        <tr>
          <td>{{$mass->mass}}</td>
          <td>{{$mass->fracIon}}</td>
          <td>N/A</td>
        </tr>
      @endif
    @endforeach
  </tbody>
</table>
@endsection
