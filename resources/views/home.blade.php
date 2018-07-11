@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-finessa">Dashboard</div>
                <div class="card-body"> 
                    <h3>Profile</h3>
                    <p><strong>Name:</strong> {{Auth::user()->name}}</p>
                @if(empty(Auth::user()->resume))
                    {!! Form::open(['action' => 'ResumesController@store' , 'method'=>'POST' , 'enctype' =>'multipart/form-data']) !!}
                    <div class="form-group">
                        <strong>{{Form::label('resume', 'Upload Resume:')}}</strong>
                        {{Form::file('resume')}}
                        {{Form::submit('submit',['class'=>'btn  btn-primary-finessa float-sm-right'])}}
                    </div>
                    {!! Form::close() !!}
                @else
                <strong>Resume:</strong><br>
                <a href="/download" class="btn btn-success">Download</a>
                {!! Form::open(['action' => ['ResumesController@update', Auth::user()->id] , 'method'=>'POST' , 'enctype' =>'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::file('resume')}}
                        {{Form::submit('Update',['class'=>'btn btn-primary-finessa'])}}
                        {{Form::hidden('_method', 'PUT')}}
                    </div>
                    {!! Form::close() !!}
                @endif
                    <h3>My Applications</h3>
                    @if(count($job_user) > 0)
                    <div id="accordion">
                        @foreach($job_user as $application)
                          <div class="card">
    <div class="card-header">
      <a class="card-link" data-toggle="collapse" href="#collapse{{$application->job_id}}">
        <h4>{{$application->jobTitle}}</h4>
      </a>
    </div>
    <div id="collapse{{$application->job_id}}" class="collapse">
      <div class="card-body">
        {!!$application->comment!!}<br><br>
         <a href="applications/{{$application->job_id}}/edit" class="btn  btn-primary-finessa">Edit</a>
        {!! Form::open(['action' => ['Jobs_UsersController@destroy', $application->job_id], 'method' => 'POST', 'class' => 'float-sm-right']) !!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Cancel Application', ['class' => 'btn btn-danger','onclick'=>"return confirm('Do you want to cancel your application?')"])}}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-center">No Applications found</p>  
                    @endif                  
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
