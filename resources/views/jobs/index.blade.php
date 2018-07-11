@extends('layouts.app')

@section('content')
<h1>Job Vacancies</h1>
@if(!Auth::guest())
	@if(Auth::user()->roles()->pluck('name') == '["admin"]')
	<a href="/join-us/create" class="btn btn-primary btn-primary-finessa">Add Job</a><br><br>
	@endif
@endif
<hr class="style-seven">
@if(count($jobs) > 0)
	@foreach($jobs as $job)
		<div class="card bg-light jobCard">
			<h2><a href="/join-us/{{$job->id}}">{{$job->jobTitle}}</a></h2>
			<small>Posted on: {{$job->created_at}}</small>
		</div>
	@endforeach
	<br>
	<span id="pageLinks">{{$jobs->links()}}</span>
@else
<p>No Jobs Available</p>
@endif
@endsection