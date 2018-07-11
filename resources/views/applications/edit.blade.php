@extends('layouts.app')

@section('content')

<h2>{{$job->jobTitle}}</h2>
<p><small><strong>Location:</strong> {{$job->location}}</small></p><br>



@foreach($job_user as $job_user)

{{ Form::open(['action'=>['Jobs_UsersController@update', $job_user->id], 'method' => 'POST']) }}
{!! Form::textarea('comment',$job_user->comment,['class'=>'form-control', 'id' => 'article-ckeditor']) !!}<br>
{{Form::hidden('_method','PUT')}}
{{Form::submit('submit',['class'=>'btn btn-primary-finessa'])}}
{{Form::close()}}

@endforeach

@endsection