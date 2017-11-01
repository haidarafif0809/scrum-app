<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	{!! Form::label('aplikasi_id', 'Aplikasi', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		<!-- {!! Form::text('aplikasi', null, ['class'=>'form-control']) !!}
			{!! $errors->first('aplikasi', '<p class="help-block">:message</p>') !!} -->
			{!! Form::select('aplikasi_id', [''=>'']+App\Aplication::pluck('nama','id')->all(), null, ['class' => 'form-control js-selectize-reguler', 'placeholder' => 'Pilih Aplikasi']) !!}
			{!! $errors->first('author_id', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
		{!! Form::label('nama_backlog', 'Nama Backlog', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			{!! Form::text('nama_backlog', null, ['class'=>'form-control']) !!}
			{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
		{!! Form::label('demo', 'Demo', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-4">
			{!! Form::textarea('demo', null, ['class'=>'form-control', 'size' => '20x2']) !!}
			{!! $errors->first('demo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
		{!! Form::label('catatan', 'Catatan', ['class'=>'col-md-2 control-label']) !!}
		<div class="col-md-10">
			{!! Form::textarea('catatan', null, ['class'=>'form-control', 'size' => '20x2', 'id' => 'editorCatatan']) !!}
			{!! $errors->first('catatan', '<p class="help-block">:message</p>') !!}

		</div>
	</div>
	<div class="form-group">
		<div class="col-md-4 col-md-offset-2">
			{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
		</div>
	</div>