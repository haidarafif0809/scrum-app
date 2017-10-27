@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/aplikasi') }}">Aplikasi</a></li>
				<li class="active">Export Aplikasi</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Export Aplikasi</h2>
				</div>
				<div class="panel-body">
					{!! Form::open(['url'=>route('export.aplikasi.post'),'method'=>'post','class'=>'form-horizontal']) !!}
				<div class="form-group {!! $errors->has('aplikasi_id') ? ' has-error':'' !!}">
					{!! Form::label('aplikasi_id','Aplikasi',['class'=>'col-md-2 control-label']) !!}
				<div class="col-md-4">
					{!! Form::select('aplikasi_id[]',[''=>'']+App\Aplication::pluck('nama','id')->all(), null, [
						'class'      => 'form-control js-selectize-reguler',
						'multiple',
						'placeholder'=> 'Pilih Aplikasi'
						]) !!}
						{!! $errors->first('aplikasi_id', '<p class="help-block">:message</p>') !!}
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