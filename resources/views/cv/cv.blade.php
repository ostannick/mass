@extends('layouts.app')

@section('content')

<div class="ui stackable grid">
  <div class="four wide column">

    <h2>Nicholas K. H. Ostan</h2>
    <img class="ui centered small circular image" src="{{asset('img/avatar.jpg')}}">

    <h3>About</h3>
    @include('cv.partials.about')
    <div class="ui divider"></div>

    <h3>Contact</h3>
    @include('cv.partials.contact')
  </div>

  <div class="twelve wide column">

    <h3>Experience & Projects</h3>
    @include('cv.partials.projects')

    <h3>Education</h3>
    <div class="ui three column stackable grid">
      <div class="column">
        @include('cv.partials.card-uoft')
      </div>
      <div class="column">
        @include('cv.partials.card-uofc')
      </div>
      <div class="column">
        @include('cv.partials.card-queens')
      </div>
    </div>

    <h3>Expertise</h3>
    @include('cv.partials.tags')


  </div>
</div>

<div class="ui divider">

</div>

@endsection
