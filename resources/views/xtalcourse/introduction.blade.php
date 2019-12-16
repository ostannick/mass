@extends('layouts.app')

@section('content')
<h1><i class="fal fa-fw fa-chart-network"></i> Crystallography Course - Introduction</h1>
<h5>Nicholas K. H. Ostan</h5>
<hr>

<p>
  I have written this course in a way such that it would represent the workflow of a typical biochemist trying to solve a protein structure using crystallography. The workflow is as follows:
</p>

<div class="ui ordered list">
  <a class="item" href="/xtalcourse/dna">Designing a suitable DNA construct for cloning and expression</a>
  <a class="item" href="/xtalcourse/purification">Purification of the protein</a>
  <a class="item" href="#">Setting up crystallization experiments</a>
  <a class="item" href="#">Differentiating salt crystals from protein crystals</a>
  <a class="item" href="#">Optimizing protein crystal hits</la>
  <a class="item" href="#">Preparing crystals for diffraction experiments</a>
  <a class="item" href="#">Carrying out a diffraction experiment</a>
  <a class="item" href="#">Understanding the diffraction pattern, and solving the phase problem</la>
  <a class="item" href="#">Understanding the Fourier transform (1D, 2D, and 3D) and its infinite uses</a>
  <a class="item" href="#">Deducing function from structure</a>
</div>

<p>
  Much of this crystallographic theory will require you to understand simple trigonometric functions. For that reason, I highly recommend that you obtain a graphing calculator or use an online one such as <a target="_blank" href="https://www.desmos.com/">Desmos</a>. We will talk in great detail about the rotating arm below that traces out a circle. Do not worry if you don't understand it yet... but it is so, so, so important to understand! I imagine if you are reading this course, you at least have a highschool level math education, but I will do my best to assume you are very rusty. It is up to you to brush up on the mathematics when I present them.
</p>
<div class="cc">
  <canvas class="course-canvas" id="canvas_sineCosine"></canvas>
  <script type="text/javascript" src="{{asset('js/canvas/sineCosine.js')}}"></script>
</div>


</script>



<span class="ui green text">$$f(\theta)=sin(\theta)$$</span>
<span class="ui red text">$$g(\theta)=cos(\theta)$$</span>

<div class="ui two buttons">

  <a href="#" class="ui disabled button grey">
    <i class="fal fa-fw fa-arrow-left"></i>
    Previous Section
  </a>

  <a href="/xtalcourse/dna" class="ui button purple">
    Next Section: Construct Design
    <i class="fal fa-fw fa-arrow-right"></i>
  </a>

</div>

<h4>Test Your Understanding:</h4>
<ol>
  <li>Plot <span class="ui green text">\(f(\theta)=sin(\theta)\)</span> and <span class="ui red text">\(g(\theta)=cos(\theta)\)</span>. Comment on the relationship between the triangle's side lengths (above) and the value for \(\theta\).</li>
  <li>Plot \(f(x)=sin(x)\) with an amplitude of 15.</li>
  <li>Plot \(f(x)=sin(x)\) with a phase offset of \(\pi/2\) radians.</li>
  <li>Plot \(f(x)=sin(x)\) with a frequency of 6.</li>
  <li>Add the functions (waves) from (2), (3), and (4) together.</li>
</ol>

@include('xtalcourse.partials.calculator')


<h4>Bibliography & Further Reading</h4>
<div class="ui list">

  <div class="item">
    <i class="fal fa-fw fa-book-open"></i>
  </div>

  <div class="item">
    <i class="fal fa-fw fa-newspaper"></i>
  </div>

</div>

@endsection

<script src="https://www.desmos.com/api/v1.4/calculator.js?apiKey=dcb31709b452b1cf9dc26972add0fda6"></script>
