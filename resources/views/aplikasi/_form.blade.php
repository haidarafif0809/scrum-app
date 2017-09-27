	<div class="form-group{{ $errors->has('kode') ? ' has-error' : '' }}">
		{!! Form::label('kode', 'Kode Aplikasi', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			{!! Form::text('kode', null, ['class'=>'form-control']) !!}
			{!! $errors->first('kode', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
		{!! Form::label('nama', 'Nama Aplikasi', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			{!! Form::text('nama', null, ['class'=>'form-control']) !!}
			{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

		<div class="form-group">
		<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
		</div>
		</div>