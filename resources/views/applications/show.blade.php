@extends('layouts.app')

@section('content')
<h1>{{$application->jobTitle}}</h1>
<a href="/join-us/{{$application->id}}" class="btn btn-primary-finessa">View Job</a><hr>
@if(count($application->applicants) > 0)
<div id="accordion">

@foreach($application->applicants as $applicant)

  <div class="card">
    <div class="card-header">
      <a class="card-link" data-toggle="collapse" href="#collapse{{$applicant->id}}">
        <h2>{{$applicant->name}}</h2>
      </a>
    </div>
    <div id="collapse{{$applicant->id}}" class="collapse">
      <div class="card-body">
        {!! $applicant->pivot->comment !!}<br>
        <a href="/resume/{{$applicant->pivot->user_id}}" class="btn btn-primary-finessa">Download Resume</a>
      </div>
    </div>
  </div>

@endforeach


</div>
@else

<p class="text-center">No Applications found</p>  

@endif
@endsection
