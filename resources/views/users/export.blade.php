@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/users') }}">Data Member</a></li>
				<li class="active">Export Data User</li>
			</ul>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Export Data User</h2>
				</div>

				<div class="panel-body">
					{!! Form::open(['url' => route('export.users.post') ,
					'method' => 'post', 'class'=>'form-horizontal']) !!}
					<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
						{!! Form::label('name', 'Nama Member', ['class'=>'col-md-2 control-label']) !!}
						<div class="col-md-4">
							{!! Form::select('name[]', [''=>'']+App\User::pluck('name','id')->all(), null, [
							'class'=>'js-selectize-reguler',
							'multiple',
							'placeholder' => '--Pilih Member--']) !!}
							{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-4 col-md-offset-2">
							{!! Form::submit('Download', ['class'=>'btn btn-primary']) !!}		 
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection