@extends('layouts.app') 

@section('title', 'Daftar SprintBacklog')

@section('content') 
<div class="container"> 
  <div class="row"> 
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Dashboard</a></li> 
        <li><a href="{{ url('/sprints') }}">Sprint</a></li> 
        <li class="active">Sprint Backlog</li> 
      </ul> 

      <div class="panel panel-default"> 
        <div class="panel-heading"> 
          <h2 class="panel-title">Sprint Backlog </h2> 
        </div> 

        <div class="panel-body">
          @if ($jumlahBacklog == 0)
          <span class="btn btn-primary" id="backlogHabis">Tambah SprintBacklog</span>
          @else
          <a class="btn btn-primary" href="{{ route('sprintbacklogs.create_sprintbacklog', $sprint) }}" id="tambah-sprintbacklog-tour">Tambah SprintBacklog</a>
          @endif

          <a class="btn btn-primary" href="{{ url('/export/sprintbacklogs',$sprint) }}">Export</a>
          <a class="btn btn-primary" href="{{ url('/exportall/sprintbacklogs',$sprint) }}">Export All</a> 
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

