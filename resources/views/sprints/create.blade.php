@extends('layouts.app') 

@section('title', 'Tambah Sprint')
 
@section('content') 
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-12"> 
        <ul class="breadcrumb"> 
          <li><a href="{{ url('/home') }}">Aplikasi</a></li> 
          <li><a href="{{ url('/sprints') }}">Sprint</a></li> 
          <li class="active">Tambah Sprint</li> 
        </ul> 
   
        <div class="panel panel-default"> 
          <div class="panel-heading"> 
            <h2 class="panel-title">Tambah Sprint</h2> 
          </div> 
 
          <div class="panel-body"> 
            {!! Form::open(['url' => route('sprints.store'), 
              'method' => 'post', 'class'=>'form-horizontal']) !!} 
                @include('sprints._form') 
            {!! Form::close() !!} 
          </div> 
        </div> 
      </div> 
    </div> 
  </div> 
@endsection

