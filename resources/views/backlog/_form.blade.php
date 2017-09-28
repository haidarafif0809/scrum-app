<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	{!! Form::label('aplikasi', 'Aplikasi', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('aplikasi', null, ['class'=>'form-control']) !!}
		{!! $errors->first('aplikasi', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	{!! Form::label('nama', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama', null, ['class'=>'form-control']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	{!! Form::label('demo', 'Demo', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('demo', null, ['class'=>'form-control']) !!}
		{!! $errors->first('demo', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	{!! Form::label('catatan', 'Catatan', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('catatan', null, ['class'=>'form-control']) !!}
		{!! $errors->first('catatan', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>