@extends('layouts.app')

@section('title', 'Ubah Kata Sandi')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active"> Ubah Kata Sandi</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Kata Sandi</h2>
				</div>

				<div class="panel-body">

					{!! Form::open(['url' => url('/settings/password'), 'method' => 'post', 'class' => 'form-horizontal']) !!}

					<div class="form-group{{ $errors->has('password') ? 'has-error' : '' }}">
						{!! Form::label('password', 'Kata Sandi lama',['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-6">
							{!! Form::password('password', ['class' => 'form-control']) !!}
							{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
						</div>
					</div>

					<div class="form-group{{ $errors->has('new_password') ? 'has-error' : '' }}">
						{!! Form::label('new_password', 'Kata Sandi baru',['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-6">
							{!! Form::password('new_password', ['class' => 'form-control']) !!}
							{!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
						</div>
					</div>

					<div class="form-group{{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
						{!! Form::label('new_password_confirmation', 'Konfirmasi Kata Sandi baru',['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-6">
							{!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
							{!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							{!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
						</div>
					</div>

					{!! Form::close() !!}

				</div>
			</div>	
		</div>
	</div>
</div>
@endsection