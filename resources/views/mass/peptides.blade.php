@extends('layouts.app')

@section('content')

  <h1>Peptide Database</h1>
  <table class="ui striped very compact teal table">
  <thead>
  <tr>
    <th>ID</th>
    <th>Job</th>
    <th>Parent</th>
    <th>Mass (Avg. Calc.)</th>
    <th>Sequence</th>
    <th>Abs. Ion.</th>
    <th>Matrix</th>
  </tr></thead>
  <tbody>
    @foreach($peptides as $peptide)
    <tr>
      <td>{{$peptide->id}}</td>
      <td>{{$peptide->job}}</td>
      <td>{{$peptide->parent}}</td>
      <td>{{$peptide->calc_mass}}</td>
      <td class="monospace">{{$peptide->sequence}}</td>
      <td>{{$peptide->abs_ion}}</td>
      <td>{{$peptide->matrix}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

  {{$peptides->links()}}
@endsection
