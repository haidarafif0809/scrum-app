@extends('layouts.app')

@section('title', 'Tambah Aplikasi')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/aplikasi') }}">Aplikasi</a></li>
				<li class="active">Tambah Aplikasi</li>
			</ul>
				<div class="panel panel-default">
			<div class="panel-heading">
			<h2 class="panel-title">Tambah Aplikasi</h2>
			</div>
	<div class="panel-body">
				{!! Form::open(['url' => route('aplikasi.store'),
				'method' => 'post', 'class'=>'form-horizontal']) !!}
				@include('aplikasi._form')
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection