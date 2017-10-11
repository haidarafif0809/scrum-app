@extends('layouts.app')
@section('title', 'Edit Aplikasi')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/aplikasi') }}">Ubah</a></li>
				<li class="active">Ubah Aplikasi</li>
			</ul>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Ubah Aplikasi</h2>
			</div>
		<div class="panel-body">
		{!! Form::model($aplication, ['url' => route('aplikasi.update', $aplication->id),
		'method'=>'put', 'class'=>'form-horizontal']) !!}
		@include('aplikasi._form')
		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection