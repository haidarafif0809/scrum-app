@extends('layouts.app') 
 
@section('content') 
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-12"> 
        <ul class="breadcrumb"> 
          <li><a href="{{ url('/home') }}">Aplikasi</a></li> 
          <li class="active">Sprint Backlog</li> 
        </ul> 
 
        <div class="panel panel-default"> 
          <div class="panel-heading"> 
            <h2 class="panel-title">Sprint Backlog</h2> 
          </div> 
           
          <div class="panel-body"> 
          <p> <a class="btn btn-primary" href="{{ route('sprintbacklogs.create') }}">Tambah</a> </p> 
            {!! $html->table(['class'=>'table-striped']) !!} 
          </div> 
        </div> 
      </div> 
    </div> 
  </div> 
@endsection 
 
@section('scripts') 
  {!! $html->scripts() !!} 
@endsection