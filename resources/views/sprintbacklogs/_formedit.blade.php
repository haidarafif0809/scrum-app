<div class="form-group{{ $errors->has('nama_backlog') ? ' has-error' : '' }}"> 
  {!! Form::label('id_backlog', 'Nama Backlog', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
{!! Form::select('id_backlog', [''=>'']+App\Backlog::pluck('nama_backlog','id_backlog')->all(), null, [  
'class'=>'form-control js-selectize-reguler', 'id' => 'id_backlog',
'placeholder' => 'Pilih Backlog']) !!}
    {!! $errors->first('id_backlog', '<p class="help-block">:message</p>') !!} 
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
    {!! Form::number('perkiraan_waktu', null, ['class'=>'form-control']) !!} 
    {!! $errors->first('perkiraan_waktu', '<p class="help-block">:message</p>') !!} 
  </div> 
</div>

<div class="form-group{{ $errors->has('asign') ? ' has-error' : '' }}"> 
  {!! Form::label('asign', 'Asign', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::text('asign', null, ['class'=>'form-control']) !!} 
    {!! $errors->first('asign', '<p class="help-block">:message</p>') !!} 
  </div> 
</div>

@if(isset($sprintbacklog)) 

{!! Form::hidden('id_sprint', $sprintbacklog->id_sprint, ['class'=>'form-control']) !!} 
@endif
<div class="form-group"> 
  <div class="col-md-4 col-md-offset-2"> 
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!} 
  </div> 
</div>