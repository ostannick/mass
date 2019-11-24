@extends('layouts.app')

@section('content')
  <h1>DEPC Solvent Accession Analyzer</h1>
  <form method="POST" action="/depc" enctype="multipart/form-data">
    @csrf
  <div class="ui big form">

    <div class="field">
      <label>Protein Sequence</label>
      <textarea name="protein_sequence"></textarea>
    </div>


    <div class="field">
      <button type="submit" class="ui teal submit button">Submit</button>
    </div>

  </div>
</form>
@endsection
