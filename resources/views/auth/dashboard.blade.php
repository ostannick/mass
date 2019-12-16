@extends('layouts.app')

@section('content')

<h1>{{Auth::user()->name}}'s Dashboard</h1>

<div class="ui grid">

</div>


<h4 class="ui horizontal divider header">
  <i class="fal fa-fw fa-chart-bar"></i>
  Services
</h4>

<button class="ui huge green compact labeled icon button">
  <i class="add icon"></i>
  Create New MALDI Job
</button>

<h4 class="ui horizontal divider header">
  <i class="fal fa-fw fa-chart-bar"></i>
  My Jobs
</h4>

@endsection
