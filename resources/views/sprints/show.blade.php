@extends('layouts.app')

@section('title', 'Detail Sprint')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Dashboard</a></li>
        <li><a href="{{ url('/sprints') }}">Sprint</a></li>
        <li class="active">Detail {{ $sprint->nama_sprint }}</li>
      </ul>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">Detail {{ $sprint->nama_sprint }}</h2>
        </div>
        <div class="panel-body">
          <div class="col-md-3">
            <b>Kode Sprint:</b>
            <br>
            {{ $sprint->kode_sprint }}
          </div>
          <div class="col-md-3">
            <b>Waktu Mulai:</b>
            <br>
            {!! $sprint->waktu_mulai !!}
          </div>
          <div class="col-md-3">
            <b>Durasi:</b>
            <br>
            {!! $sprint->durasi !!}
          </div>
          <div class="col-md-3">
            <b>Goal:</b>
            <br>
            {!! $sprint->goal !!}
          </div>
        </p>
      </div>
    </div>
  </div>
</div>
</div>
@endsection