@extends('layouts.app') 

@section('title', 'Daftar Sprint')

@section('content') 
<div class="container"> 
  <div class="row"> 
    <div class="col-md-12">
      <ul class="breadcrumb"> 
        <li><a href="{{ url('/home') }}">Dashboard</a></li> 
        <li class="active">Sprint</li> 
      </ul> 
      
      <div class="panel panel-default"> 
        <div class="panel-heading"> 
          <h2 class="panel-title">Sprint</h2> 
        </div> 
        
        <div class="panel-body"> 
          <p> <a class="btn btn-primary" href="{{ route('sprints.create') }}" id="tambah-sprint-tour">Tambah</a> 
            <a class="btn btn-primary" href="{{ url('/export/sprints') }}">Export</a> 
            <a class="btn btn-primary" href="{{ url('/exportall/sprints') }}">Export All</a>   
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