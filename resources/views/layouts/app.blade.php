<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Lab Tools</title>

        <!--CSS Libraries-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.7.7/dist/semantic.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.1/css/all.css" integrity="sha384-y++enYq9sdV7msNmXr08kJdkX4zEI1gMjjkw0l9ttOepH7fMdhb7CePwuRQCfwCr" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/app.css">

        <!--Javascript Libraries-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.7.7/dist/semantic.min.js"></script>
        <script src="{{asset('js/init.js')}}"></script>

    </head>

    <body>

      <div id="app">
        @include('layouts.sidebar')

        <div class="pusher">
          @include('layouts.navbar')
          <div class="ui container">
              @yield('content')
          </div>
        </div>
      </div>

      <!-- Load Vue here -->

    </body>

    <footer>

    </footer>
  </html>
