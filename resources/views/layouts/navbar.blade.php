<div class="navbar">

  <li class="main item"><a href="/cv"><i class="fal fa-fw fa-wave-square"></i></a></li>
  <li class="item sandwich"><i class="fal fa-fw fa-bars"></i></li>
  <li class="item">
    <i class="fal fa-fw fa-chart-bar"></i> Mass Spectrometry Tools
    <ul>
      <a href="/mass"><li>Peptide Mass Fingerprinting Analysis</li></a>
      <a href="/peptides"><li>Peptide Database</li></a>
      <a href="/peptides"><li>Peptide Analytics</li></a>
      <a href="/nn"><li>Train Neural Network</li></a>
    </ul>
  </li>
  <li class="item">
    <i class="fal fa-fw fa-chart-network"></i> Crystallography Tools
    <ul>
      <a href="#"><li></li></a>
    </ul>
  </li>
  <li class="item">
    <i class="fal fa-fw fa-atom-alt"></i> NMR Tools
    <ul>
      <a href="#"><li>PROSECCO Graphs</li></a>
      <a href="#"><li>Low Hanging Fruit</li></a>
    </ul>
  </li>
  <li class="item">
    <i class="fal fa-fw fa-cog"></i> Entrez Utilities
    <ul>
      <a href="/entrez"><li>Get Genomic Context</li></a>
    </ul>
  </li>
  <li class="item">
    <i class="fal fa-fw fa-bacon"></i>Cloning Suite
    <ul>
      <a href="/primers"><li>Primer & Construct Design</li></a>
      <a href="/assembler"><li>Sequence Assembler</li></a>
    </ul>
  </li>
  <li class="item">
    <i class="fal fa-fw fa-book-reader"></i> Learning
    <ul>
      <a href="/books"><li>Book List</li></a>
      <a href="/python"><li>Python for Graduate Studies</li></a>
      <a href="/glossary"><li>Glossary</li></a>
    </ul>
  </li>

  <div class="navbar-login">
    <li><button class="ui violet button disabled">Register</button></li>
    <li><button id="login-button" class="ui teal button">Log In</button></li>
  </div>
</div>


@guest
<div id="login-modal" class="ui modal">
  <div class="header">Log In</div>
  <div class="content">
    <div class="ui massive form">
  <div class="two fields">
    <div class="field">
      <input placeholder="Username" type="text">
    </div>
    <div class="field">
      <input placeholder="Password" type="password">
    </div>
  </div>
</div>
  </div>
  <div class="actions">
    <div class="ui red cancel button">Cancel</div>
    <div class="ui teal button">Login</div>
  </div>
</div>
@endguest
