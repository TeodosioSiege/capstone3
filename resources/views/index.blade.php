@extends('layouts.app')

@section('content')
<h1 class="text-center">{{$title}}</h1>

<hr class="style-seven">


<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="imageCarousel mx-auto d-block" src="/storage/images/hiring1.jpg">
    </div>
    <div class="carousel-item">
      <img class="imageCarousel mx-auto d-block"  src="/storage/images/hiring2.jpg">
    </div>
    <div class="carousel-item">
      <img class="imageCarousel mx-auto d-block"  src="/storage/images/hiring3.jpg">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>

@endsection