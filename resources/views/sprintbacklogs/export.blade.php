@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/sprintbacklogs') }}">Sprintbacklog</a></li>
					<li class="active">Export Sprintbacklog</li>
				</ul>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Export Sprintbacklog</h2>
					</div>
					
					<div class="panel-body">
						{!! Form::open(['url' => route('export.sprintbacklogs.post'), 
						'method' => 'post', 'class'=>'form-horizontal']) !!}

						<div class="form-group {!! $errors->has('id_backlog') ? 'has-error' : '' !!}">
							{!! Form::label('id_backlog', 'Nama Backlog', ['class'=>'col-md-2 control-label']) !!}
													
							<div class="col-md-4">
								{!! Form::select('id_backlog', [''=>'']+App\Backlog::pluck('nama_backlog','id_backlog')->all(), null, [
									'class'=>'js-selectize-reguler',
									'multiple',
									'placeholder' => 'Pilih Backlog']) !!}
								{!! $errors->first('backlog', '<p class="help-block">:message</p>') !!}

								{!! Form::hidden('id_sprint', $sprint, ['class'=>'form-control']) !!} 
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