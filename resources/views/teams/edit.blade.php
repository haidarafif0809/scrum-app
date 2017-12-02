@extends('layouts.app')

@section('title', 'Ubah Team')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/teams') }}">Team</a></li>
				<li class="active">Ubah Team</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Team</h2>
				</div>

				<div class="panel-body">
					{!! Form::model($team, ['url' => route('teams.update', $team->id),
					'method'=>'put', 'class'=>'form-horizontal']) !!}
					@include('teams._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
