@extends('layouts.app')

@section('content')
  <h1>Tryptic Digest Analyzer</h1>
  <form method="POST" action="/mass" enctype="multipart/form-data">
    @csrf
  <div class="ui big form">
    <div class="field">
    </div>

    <div class="field">
      <div class="field">
        <label>Protein Name<i class="fal fa-fw fa-question-circle"></i></label>
        <input name="protein_name" placeholder="Moraxella bovis n114 LbpB" type="text" value="">
      </div>
    </div>


      <div class="field">
        <label>Protein Sequence</label>
        <textarea class="monospace" name="protein_sequence"></textarea>
      </div>

      <div class="field">
        <label>Upload Mass List</label>
        <input type="file" name="peaks">
      </div>


    <div class="three fields">
      <div class="field">
        <label>Mass Tolerance (Da)<i class="fal fa-fw fa-question-circle"></i></label>
        <input name="mass_tolerance" placeholder="Mass Tolerance (Da)" type="text" value="1.5">
      </div>
      <div class="field">
        <label>Peptide Charge State<i class="fal fa-fw fa-question-circle"></i></label>
        <input name="charge_state" placeholder="Peptide Charge State" type="text" value="1">
      </div>
      <div class="field">
        <label>Intact Mass<i class="fal fa-fw fa-question-circle"></i></label>
        <input name="intact_mass" placeholder="Intact Mass" type="text" value="">
      </div>
    </div>

    <div class="two fields">
      <div class="field">
        <label>Lower Mass Cutoff (Da)<i class="fal fa-fw fa-question-circle"></i></label>
        <input name="cutoff_low" placeholder="500" type="text" value="500">
      </div>
      <div class="field">
        <label>Upper Mass Cutoff (Da)<i class="fal fa-fw fa-question-circle"></i></label>
        <input name="cutoff_high" placeholder="4000" type="text" value="4000">
      </div>
    </div>

    <div class="two fields">
      <div class="field">
        <label>Matrix</label>
          <div class="ui selection dropdown">
              <input type="hidden" name="matrix">
              <i class="dropdown icon"></i>
              <div class="default text">Matrix</div>
              <div class="menu">
                  <div class="item" data-value="HCCA" selected>a-4-cyano-hydroxycinaminnic acid (HCCA)</div>
                  <div class="item" data-value="SA">Sinnapinic Acid (SA)</div>
                  <div class="item" data-value="DHB">Dihydroxybenzoic Acid (DHB)</div>
              </div>
          </div>
      </div>
    </div>

    <div class="ui message">
      <div class="header">Notes:</div>
      <ul class="list">
        <li>Proteins assumed to be treated with iodoacetamide</li>
        <li>Proteins assumed to be treated with trypsin</li>
      </ul>
    </div>

    <button type="submit" class="ui submit button">Submit</button>

  </div>
</form>
@endsection
