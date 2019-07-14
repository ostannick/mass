<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lab Tools</title>

        <!--CSS Libraries-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.7.6/dist/semantic.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-vlOMx0hKjUCl4WzuhIhSNZSm2yQCaf0mOU1hEDK/iztH3gU4v5NMmJln9273A6Jz" crossorigin="anonymous">

        <!--Javascript Libraries-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.7.6/dist/semantic.min.js"></script>
        <script src="{{asset('js/init.js')}}"></script>

    </head>
    <body>

      <div class="ui container">

        <h1>Tryptic Digest Analyzer</h1>
        <form method="POST" action="/mass">
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
              <textarea></textarea>
            </div>

          <div class="two fields">
            <div class="field">
              <label>Mass Spectrum</label>
              <textarea></textarea>
            </div>

            <div class="field">
              <label>Peak List</label>
              <textarea></textarea>
            </div>
          </div>


          <div class="three fields">
            <div class="field">
              <label>Mass Tolerance (Da)<i class="fal fa-fw fa-question-circle"></i></label>
              <input placeholder="Mass Tolerance (Da)" type="text" value="1.5">
            </div>
            <div class="field">
              <label>Peptide Charge State<i class="fal fa-fw fa-question-circle"></i></label>
              <input placeholder="Peptide Charge State" type="text" value="1">
            </div>
            <div class="field">
              <label>Intact Mass<i class="fal fa-fw fa-question-circle"></i></label>
              <input placeholder="Intact Mass" type="text" value="">
            </div>
          </div>

          <div class="two fields">
            <div class="field">
              <label>Lower Mass Cutoff (Da)<i class="fal fa-fw fa-question-circle"></i></label>
              <input placeholder="500" type="text" value="500">
            </div>
            <div class="field">
              <label>Upper Mass Cutoff (Da)<i class="fal fa-fw fa-question-circle"></i></label>
              <input placeholder="4000" type="text" value="4000">
            </div>
          </div>

          <div class="two fields">
            <div class="field">
              <label>Matrix</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="gender">
                    <i class="dropdown icon"></i>
                    <div class="default text">Matrix</div>
                    <div class="menu">
                        <div class="item" data-value="1" selected>a-4-cyano-hydroxycinaminnic acid (HCCA)</div>
                        <div class="item" data-value="0">Sinnapinic Acid (SA)</div>
                        <div class="item" data-value="0">Dihydroxybenzoic Acid (DHB)</div>
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


      </div>
    </body>
</html>
