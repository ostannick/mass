<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lab Tools</title>

        <!--CSS Libraries-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.7.6/dist/semantic.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-vlOMx0hKjUCl4WzuhIhSNZSm2yQCaf0mOU1hEDK/iztH3gU4v5NMmJln9273A6Jz" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/css/app.css">

        <!--Javascript Libraries-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.7.6/dist/semantic.min.js"></script>
        <script src="{{asset('js/init.js')}}"></script>

    </head>
    <body>



    <div class="ui container">
      <h1>{{$protein_name}}</h1>
      <h5>{{\Carbon\Carbon::now()}}</h2>

    <div class="ui divider"></div>

    <h3>Protein Sequence Coverage</h5>

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

    <div class="ui two column grid">
      <div class="row">
        <div class="column">
          <h3>Peptide Analysis - <span style="font-style: italic">in silico</span> Digest</h5>
          <table class="ui celled table">
          <thead>
            <tr>
              <th>Peptide Sequence</th>
              <th>Mass</th>
              <th>Match</th>
            </tr>
          </thead>
          <tbody>
            @foreach($analysis->peptides as $peptide)
              @if($peptide->visibility)
                @if($peptide->observed)
                <tr class="positive">
                  <td class="monospace">{{$peptide->sequence}}</td>
                  <td>{{$peptide->mass}}</td>
                  <td><i class="icon checkmark"></i></td>
                </tr>
                @else
                <tr class="negative">
                  <td class="monospace">{{$peptide->sequence}}</td>
                  <td>{{$peptide->mass}}</td>
                  <td><i class="icon delete"></i></td>
                </tr>
                @endif
              @endif
            @endforeach
          </tbody>
        </table>
        </div>

        <div class="column">
          <h3>Mass Spectrum</h3>
        </div>
      </div>



    </div>

      </div>

    </body>
</html>
