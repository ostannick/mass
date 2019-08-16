@extends('layouts.app')

@section('content')

<div class="ui icon message">
<i class="wave square icon"></i>
<div class="content">
  <div class="header">
    Chemical Shift Prediction Visualizer
  </div>
  <p>Upload your chemical shift prediction spreadsheet from PROSECCO. This tool
    will generate 2D spectra for 1H, 15N, and 13C. It will also pick out any low-hanging
    fruit assignments.
  </p>
</div>
</div>

<form method="POST" action="/prosecco" enctype="multipart/form-data">
  @csrf
<div class="ui big form">
  <div class="field">
  </div>

  <div class="field">
    <div class="field">
      <label>Protein Name<i class="fal fa-fw fa-question-circle"></i></label>
      <input name="protein_name" placeholder="i.e. CaHD" type="text" value="">
    </div>
  </div>


  <div class="field">
    <label>Upload Chemical Shifts</label>
    <input type="file" name="cs">
  </div>

  <div class="field">
    <button type="submit" class="ui teal submit button">Submit</button>
  </div>

</div>
</form>

<div class="ui teal message">
  <i class="close icon"></i>
  <div class="header">
    Important
  </div>
  <ul class="list">
    <li>Ensure your excel file does not contain any merged/missing columns/rows.</li>
  </ul>
</div>




@endsection
