@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/backlog') }}">Backlog</a></li>
					<li class="active">Ubah {{ $backlog->nama_backlog }} </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Ubah {{ $backlog->nama_backlog }} </h2>
					</div>
					<div class="panel-body">
						{!! Form::model($backlog, ['url' => route('backlog.update', $backlog->id_backlog), 'method' => 'put', 'files' => 'false', 'class' => 'form-horizontal']) !!}
							@include('backlog._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection