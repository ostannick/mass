@extends('layouts.app')

@section('content')
<h1>NCBI Entrez Utilities</h1>
<div class="ui top attached tabular menu">
  <a class="item active" data-tab="first">Download Sequences</a>
  <a class="item" data-tab="second">Genomic Context</a>
  <a class="item" data-tab="third">Third</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="first">
  <form class="ui form" action="/entrez/records" method="post">
    @csrf
    <div class="field">
     <label>Database</label>
     <div class="ui selection dropdown">
         <input type="hidden" name="db">
         <i class="dropdown icon"></i>
         <div class="default text">Database</div>
         <div class="menu">
             <div class="item" data-value="protein">Protein</div>
             <div class="item" data-value="gene">Gene</div>
         </div>
     </div>
   </div>
    <div class="field">
    <label>Search Term</label>
    <input type="text" name="search_query" placeholder="(e.g. lactoferrin-binding protein B)">
    </div>
    <div class="field">
    <label>Record Limit</label>
    <input type="text" name="retmax" value="100">
    </div>
    <button class="ui teal button" type="submit" name="button">Fetch</button>
  </form>

</div>
<div class="ui bottom attached tab segment" data-tab="second">

</div>
<div class="ui bottom attached tab segment" data-tab="third">

</div>

@endsection
