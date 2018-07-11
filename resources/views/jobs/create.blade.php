@extends('layouts.app')

@section('content')
	<h1>Create Job Posting</h1>
	<hr class="style-seven">

{!!Form::open(['action'=>'JobsController@store', 'method' => 'POST'])!!}
	<div class="form">
		{!!Form::label('jobTitle','Job Title')!!}
		{!!Form::text('jobTitle','',['class' => 'form-control form-finessa', 'placeholder' => 'Enter Job Title'])!!}
	</div>
	<div class="form">
		{!!Form::label('location','Location')!!}
		{!!Form::text('location','',['class' => 'form-control form-finessa', 'placeholder' => 'Enter Location'])!!}
	</div>
	<div class="form">
		{!!Form::label('minQualifications','Minimum Qualifications')!!}
		{!!Form::textarea('minQualifications','',['class' => 'form-control form-finessa', 'placeholder' => 'Enter Qualifications...', 'id' => 'article-ckeditor'])!!}
	</div><br>
	{{Form::submit('submit',['class' => 'btn btn-primary btn-primary-finessa'])}}
{!!Form::close()!!}
@endsection

