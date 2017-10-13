@extends('layouts.app')

@section('title', 'Tambah Backlog')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/backlog') }}">Backlog</a></li>
					<li class="active">Tambah Backlog</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Tambah Backlog</h2>
					</div>
					<div class="panel-body">
						{!! Form::open(['url' => route('backlog.store'), 'method' => 'post', 'files' => 'false', 'class' => 'form-horizontal']) !!}
							@include('backlog._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection