@extends('layouts.app')

@section('title', 'Tambah Sprintbacklog')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Dashboard</a></li>
        <li><a href="{{ url('/sprints') }}">Sprint</a></li>
        <li><a href="{{ url('/sprintbacklogs', $sprint) }}">Sprintbacklog</a></li>
        <li class="active">Tambah Sprintbacklog</li>
      </ul>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">Tambah Sprintbacklog</h2>
        </div>

        <div class="panel-body">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#form" aria-controls="form" role="tab" data-toggle="tab">
                <i class="fa fa-pencil-square-o"></i> Isi Form
              </a>
            </li>
            <li role="presentation">
              <a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">
                <i class="fa fa-cloud-upload"></i> Upload Excel
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="form">
              <br>
              {!! Form::open(['url' => route('sprintbacklogs.store'),
              'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal']) !!}
              @include('sprintbacklogs._form')
              {!! Form::close() !!}
            </div>

            <div role="tabpanel" class="tab-pane" id="upload">
              <br>
              {!! Form::open(['url' => route('import.sprintbacklogs',$sprint),
              'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal']) !!}
              @include('sprintbacklogs._import')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
