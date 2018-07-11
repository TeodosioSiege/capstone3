@extends('layouts.app')

@section('content')
<h1>Applications</h1>

@foreach($applications as $application)
	@if(count($applicants = $application->applicants) > 0)
		<div class="card bg-light jobCard" style="padding:10px;">
			<h2><a href="/applications/{{$application->id}}">{{$application->jobTitle}}</a></h2>
			{!! Form::open(['action' => ['Jobs_UsersController@destroy', $application->id], 'method' => 'POST', 'class' => 'float-sm-right']) !!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Close Application', ['class' => 'btn btn-danger','onclick'=>"return confirm('Do you want to close this application?')"])}}
        {!! Form::close() !!}
		</div><br>
	@endif
@endforeach

@endsection

