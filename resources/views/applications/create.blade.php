@extends('layouts.app')

@section('content')

<h1>Confirm Application</h1>

<p><strong>Name:</strong> {{$user->name}}</p>

<p><strong>Position applied:</strong> {{$job->jobTitle}}</p>

{!!Form::open(['action'=>'Jobs_UsersController@store', 'method'=>'POST'])!!}
	{!! Form::hidden('user_id',$user->id) !!}
	{!! Form::hidden('job_id',$job->id) !!}
	{!! Form::textarea('comment','',['class' => 'form-control form-finessa', 'placeholder' => 'Enter comments...' ]) !!}<br>
	{{Form::submit('submit',['class' => 'btn btn-primary-finessa'])}}
	<a href="/join-us/{{$job->id}}" class="btn btn-danger float-sm-right">Cancel</a>
{{Form::close()}}



@endsection