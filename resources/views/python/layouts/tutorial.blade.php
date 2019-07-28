@extends('layouts.app')

@section('content')
<div class="ui grid">
  <div class="three wide column">
    @include('python.lessons.list')
  </div>
  <div class="thirteen wide column">
    @yield('lesson')
  </div>

</div>
@endsection
