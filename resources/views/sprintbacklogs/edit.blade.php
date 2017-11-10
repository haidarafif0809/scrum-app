@extends('layouts.app') 

@section('title', 'Ubah Sprint Backlog')
 
@section('content') 
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-12"> 
        <ul class="breadcrumb"> 
          <li><a href="{{ url('/home') }}">Dashboard</a></li> 
          <li><a href="{{ url('/sprintbacklogs') }}">Sprintbacklog</a></li>
          <li class="active">Ubah Sprint Backlog</li> 
        </ul> 
   
        <div class="panel panel-default"> 
          <div class="panel-heading"> 
            <h2 class="panel-title">Ubah Sprint Backlog</h2> 
          </div> 
         
        <div class="panel-body"> 
          {!! Form::model($sprintbacklog, ['url' => route('sprintbacklogs.update', $sprintbacklog->id), 
            'method'=>'put', 'class'=>'form-horizontal']) !!} 
            @include('sprintbacklogs._formedit') 
          {!! Form::close() !!} 
        </div> 
      </div> 
    </div> 
  </div> 
</div> 
@endsection