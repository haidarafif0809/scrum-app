 
<div class="form-group{{ $errors->has('backlog') ? ' has-error' : '' }}"> 
  {!! Form::label('backlog', 'Backlog', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
{!! Form::select('backlog', [''=>'']+App\Backlog::pluck('nama','id')->all(), null, [
'class'=>'js-selectize',
'placeholder' => 'Pilih Team']) !!}
    {!! $errors->first('backlog', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 
 
<div class="form-group{{ $errors->has('isi_kepentingan') ? ' has-error' : '' }}"> 
  {!! Form::label('isi_kepentingan', 'Isi Kepentingan', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::number('isi_kepentingan', null, ['class'=>'form-control']) !!} 
    {!! $errors->first('isi_kepentingan', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 
 
<div class="form-group{{ $errors->has('perkiraan_waktu') ? ' has-error' : '' }}"> 
  {!! Form::label('perkiraan_waktu', 'Perkiraan Waktu', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::text('perkiraan_waktu', null, ['class'=>'form-control']) !!} 
    {!! $errors->first('perkiraan_waktu', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 
 
<div class="form-group"> 
  <div class="col-md-4 col-md-offset-2"> 
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!} 
  </div> 
</div>