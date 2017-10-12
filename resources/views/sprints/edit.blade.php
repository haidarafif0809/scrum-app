@extends('layouts.app') 

@section('title', 'Ubah Sprint')
 
@section('content') 
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-12"> 
        <ul class="breadcrumb"> 
          <li><a href="{{ url('/home') }}">Dashboard</a></li> 
          <li><a href="{{ url('/sprints') }}">Sprint</a></li> 
          <li class="active">Ubah Sprint</li> 
        </ul> 
 
        <div class="panel panel-default"> 
          <div class="panel-heading"> 
            <h2 class="panel-title">Ubah Sprint</h2> 
          </div> 
 
          <div class="panel-body"> 
            {!! Form::model($sprint, ['url' => route('sprints.update', $sprint->id), 
              'method'=>'put', 'class'=>'form-horizontal']) !!} 
              @include('sprints._form') 
            {!! Form::close() !!} 
          </div> 
        </div> 
      </div> 
    </div> 
  </div> 
@endsection