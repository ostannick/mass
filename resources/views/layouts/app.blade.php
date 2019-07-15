<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lab Tools</title>

        <!--CSS Libraries-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.7.6/dist/semantic.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-vlOMx0hKjUCl4WzuhIhSNZSm2yQCaf0mOU1hEDK/iztH3gU4v5NMmJln9273A6Jz" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/app.css">

        <!--Javascript Libraries-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.7.6/dist/semantic.min.js"></script>
        <script src="{{asset('js/init.js')}}"></script>

    </head>

    <body>

      <div class="ui container">
        <header>
          @include('layouts.navbar')
          @yield('content')
      </div>

    </body>
  </html>
