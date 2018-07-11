@extends('layouts.app')

@section('content')
	<h1>Edit Job Posting</h1>
	<hr class="style-seven">

{!!Form::open(['action'=>['JobsController@update', $job->id], 'method' => 'POST'])!!}
	<div class="form">
		{!!Form::label('jobTitle','Job Title')!!}
		{!!Form::text('jobTitle',$job->jobTitle,['class' => 'form-control form-finessa', 'placeholder' => 'Enter Job Title'])!!}
	</div>
	<div class="form">
		{!!Form::label('location','Location')!!}
		{!!Form::text('location',$job->location,['class' => 'form-control form-finessa', 'placeholder' => 'Enter Location'])!!}
	</div>
	<div class="form">
		{!!Form::label('minQualifications','Minimum Qualifications')!!}
		{!!Form::textarea('minQualifications',$job->minQualifications,['class' => 'form-control form-finessa', 'placeholder' => 'Enter Qualifications...', 'id' => 'article-ckeditor'])!!}
	</div><br>
	{{Form::hidden('_method','PUT')}}
	{{Form::submit('submit',['class' => 'btn btn-primary-finessa'])}}
{!!Form::close()!!}
@endsection