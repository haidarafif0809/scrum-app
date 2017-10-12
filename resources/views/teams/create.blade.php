@extends('layouts.app')

@section('title', 'Tambah Team')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/teams') }}">Team</a></li>
					<li class="active">Tambah Team</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Tambah Team</h2>
					</div>

					<div class="panel-body">
						{!! Form::open(['url' => route('teams.store'),
						'method' => 'post', 'class'=>'form-horizontal']) !!}
						@include('teams._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection