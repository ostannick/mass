@extends('layouts.app')

@section('content')

    <h1 class="ui teal"></h1>
    <h5>{{\Carbon\Carbon::now()->toDayDateTimeString()}}</h2>

<div class="ui divider"></div>

<h3>Peptide Analysis - <span style="font-style: italic">in silico</span> Digest</h5>
<table class="ui compact celled table">
<thead>
  <tr>
    <th>id</th>
    <th>Group</th>
    <th>Sequence</th>
    <th>m/z</th>
    <th>Shift</th>
    <th>Modifications</th>
    <th>Tolerance Conflicts</th>
    <th>Observed</th>
  </tr>
</thead>
<tbody class="monospace">
  @foreach($analysis as $peptide)
  <tr class="positive">
    <td>{{$peptide->id}}</td>
    <td>{{$peptide->group}}</td>
    <td>{{$peptide->sequence}}</td>
    <td>{{$peptide->mz1}}</td>
    <td>{{$peptide->massShift}}</td>
    <td>
    @foreach(json_decode($peptide->modifications) as $mod)
    {{$mod}}<br/>
    @endforeach
    </td>
    <td>{{$peptide->toleranceConflicts}}</td>
    <td><i class="icon checkmark"></i></td>
  </tr>
  @endforeach
</tbody>
</table>

@endsection
