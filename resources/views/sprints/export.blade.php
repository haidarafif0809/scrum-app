@extends('layouts.app')

@section('content') 
<div class="container"> 
  <div class="row"> 
    <div class="col-md-12"> 
      <ul class="breadcrumb"> 
        <li><a href="{{ url('/home') }}">Dashboard</a></li> 
        <li><a href="{{ url('/sprints') }}">Sprint</a></li> 
        <li class="active">Export Sprint</li> 
      </ul> 
      <div class="panel panel-default"> 
        <div class="panel-heading"> 
          <h2 class="panel-title">Export Sprint</h2> 
        </div> 
        <div class="panel-body"> 
          {!! Form::open(['url'=>route('export.sprints.post'),'method'=>'post','class'=>'form-horizontal']) !!} 
          <div class="form-group {!! $errors->has('nama_sprint') ? ' has-error':'' !!}"> 
            {!! Form::label('nama_sprint','Nama Sprint',['class'=>'col-md-2 control-label']) !!} 
            <div class="col-md-4"> 
              {!! Form::select('nama_sprint[]',[''=>'']+App\Sprint::pluck('nama_sprint','id')->all(), null, [ 
              'class'      => 'form-control js-selectize-reguler', 
              'multiple', 
              'placeholder'=> 'Pilih Sprint' 
              ]) !!} 
              {!! $errors->first('nama_sprint', '<p class="help-block">:message</p>') !!} 
            </div> 
          </div> 
          <div class="form-group"> 
            <div class="col-md-4 col-md-offset-2"> 
              {!! Form::submit('Download', ['class'=>'btn btn-primary']) !!} 
            </div> 
          </div> 
          {!! Form::close() !!} 
        </div> 
      </div> 
    </div> 
  </div> 
</div> 
@endsection