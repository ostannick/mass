<div class="navbar">

  <li class="main item"><a href="/"><i class="fal fa-fw fa-wave-square"></i></a></li>
  <li class="item sandwich"><i class="fal fa-fw fa-bars"></i></li>
  <li class="item">
    <i class="fal fa-fw fa-chart-bar"></i> Mass Spectrometry
    <ul>
      <a href="/mass"><li>Peptide Mass Fingerprinting Analysis</li></a>
      <a href="/peptides"><li>Peptide Database</li></a>
      <a href="/nn"><li>MALDI Ionization Predictor</li></a>
      <a href="/depc"><li>MALDI DEPC Library Search</a></a>
      <a href="/hdxl"><li>High-Density Crosslinking Analysis</a></a>
    </ul>
  </li>
  <li class="item">
    <i class="fal fa-fw fa-chart-network"></i> Crystallography
    <ul>
      <a href="/xtalcourse"><li>Online Course</li></a>
      <a href="/books"><li>Book</li></a>
    </ul>
  </li>
  <li class="item">
    <i class="fal fa-fw fa-atom-alt"></i> NMR Tools
    <ul>
      <a href="/prosecco"><li>Visualize Chemical Shift Predictions</li></a>
    </ul>
  </li>

  <div class="navbar-login">
    @guest
    <li><a href="/register" class="ui purple button">Register</a></li>
    <li><button id="login-button" class="ui teal button">Log In</button></li>
    @endguest



    @auth

    @if(Auth::user()->admin)
    <li><a href="/admin" class="ui teal button">Admin</a></li>
    @endif

    <li><a href="/dashboard" class="ui blue button">Dashboard</a></li>
    <li><a href="/logout" class="ui red button">Log Out</a></li>
    @endauth
  </div>
</div>


@guest

<div id="login-modal" class="ui modal">
  <div class="header">Log In</div>
  <div class="content">

    <form class="ui massive form" method="POST" action="{{ route('login') }}">
      @csrf
      <div class="two fields">
        <div class="field">
          <input placeholder="Email" name="email" type="text" autofocus>
        </div>
        <div class="field">
          <input placeholder="Password" name="password" type="password">
        </div>
      </div>
      <button type="submit" class="ui fluid huge teal button">Login</button>
    </form>
    </div>

  </div>

@endguest
