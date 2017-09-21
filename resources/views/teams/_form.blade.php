<div class="form-group{{ $errors->has('kode_team') ? ' has-error' : '' }}">
	{!! Form::label('kode_team', 'Kode Team', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('kode_team', null, ['class'=>'form-control']) !!}
		{!! $errors->first('kode_team', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('nama_team') ? ' has-error' : '' }}">
	{!! Form::label('nama_team', 'Nama Team', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama_team', null, ['class'=>'form-control']) !!}
		{!! $errors->first('nama_team', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>
