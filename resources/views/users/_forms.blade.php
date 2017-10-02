<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
{!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
		{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
{!! Form::label('email', 'Email', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::email('email', null, ['class'=>'form-control']) !!}
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {!! $errors->has('otoritas') ? 'has-error' : '' !!}">
	{!! Form::label('otoritas', 'Otoritas', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('otoritas', [''=>'']+App\Role::pluck('name', 'id')->all(), null, [ 'class'=>'form-control js-selectize', 'placeholder' => '--PILIH  OTORITAS--']) !!}
		
		{!! $errors->first('otoritas', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {!! $errors->has('team_id') ? 'has-error' : '' !!}">
	{!! Form::label('team_id', 'Team', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('team_id', App\Team::pluck('nama_team','id')->all(), null, ['class'=>'form-control js-selectize', 'placeholder' => '--PILIH TEAM--']) !!}
		{!! $errors->first('team_id', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>