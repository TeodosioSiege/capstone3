@extends('layouts.app')

@section('content')
	<a  class="btn btn-secondary" href="{{URL::previous()}}">Back</a><br><br><hr class="style-seven">
	<h1>{{$job->jobTitle}}</h1>
	<small>Posted on: {{$job->created_at}}</small><br>
	<small>Location: {{$job->location}}</small>
	<div>
		{!! $job->minQualifications !!}
	</div>

@if(!Auth::guest())
	@if(Auth::user()->roles()->pluck('name') == '["admin"]')
	<a  class="btn btn-primary-finessa" href="/join-us/{{$job->id}}/edit">Edit</a>

    {!!Form::open(['action' => ['JobsController@destroy', $job->id],
                          'method' => 'POST' , 'class'=> 'float-sm-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Do you want to delete this item?')"])}}
    {!! Form::close() !!}
 <br>
 	@endif
@endif


@if(!Auth::guest())
	@if(Auth::user()->roles()->pluck('name') == '["admin"]') @else
<a href="{{route('apply' ,['job_id'=>$job->id])}}" class="btn btn-primary-finessa">Apply</a>
 	@endif
@endif
@endsection