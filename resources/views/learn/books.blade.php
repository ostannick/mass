@extends('layouts.app')

@section('content')

<h1>Handbook List</h1>
<div class="ui segment">

  <h3>Mathematical Intuition for Biomolecular Crystallography</h3>
  <h4>Nicholas Ostan; 2019</h4>

  <p>Mathematical Intuition for Biomolecular Crystallography (MIBMC) is a work-in-progress lab manual being written in an effort to understand the abstract
  mathematical concepts underlying protein crystallography. Mathematical concepts are presented in a visualized way.</p>

  <p>This resource was originally created as a lab manual for an undergraduate laboratory course at the University of Toronto.</p>

  <a href="/downloads/MIBMC_2019.pdf" class="big ui blue button">
  <i class="fal fa-fw fa-file-download"></i>
  Download PDF
</a>
</div>

<div class="ui segment">

  <h3>Making Beautiful Figures</h3>
  <h4>Nicholas Ostan; 2019</h4>

  <p>This is a LaTeX-formatted manual covering how to draw common biological entities such as lipid bilayers, etc. in Adobe Illustrator.</p>


  <a href="/downloads/MBF_2019.pdf" class="big ui purple button">
  <i class="fal fa-fw fa-file-download"></i>
  Download PDF
  </button>
</a>
</div>

<div class="ui segment">

  <h3>Mass Spectrometry Fundamentals</h3>
  <h4>Nicholas Ostan; 2019</h4>

  <p>Another work-in-progress that outlines basic mass spectrometry ideas for work in molecular biology.</p>

  <button class="big ui orange button disabled">
  <i class="fal fa-fw fa-file-download"></i>
  Download PDF
  </button>
</div>

@endsection
