<div class="form-group{{ $errors->has('nama_backlog') ? ' has-error' : '' }}"> 
  {!! Form::label('id_backlog', 'Nama Backlog', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::select('id_backlog', [''=>'']+App\Backlog::whereNotIn('id_backlog', $idBacklog)->pluck('nama_backlog','id_backlog')->all(), null, [  
    'class'=>'form-control js-selectize-reguler', 'id' => 'id_backlog',
    'placeholder' => 'Pilih Backlog']) !!}
    {!! $errors->first('id_backlog', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

<div class="form-group{{ $errors->has('isi_kepentingan') ? ' has-error' : '' }}"> 
  {!! Form::label('isi_kepentingan', 'Isi Kepentingan', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::number('isi_kepentingan', null, ['class'=>'form-control', 'id' => 'isi_kepentingan']) !!} 
    {!! $errors->first('isi_kepentingan', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

<div class="form-group{{ $errors->has('perkiraan_waktu') ? ' has-error' : '' }}"> 
  {!! Form::label('perkiraan_waktu', 'Perkiraan Waktu', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::text('perkiraan_waktu', null, ['class'=>'form-control', 'id' => 'perkiraan_waktu', 'placeholder' => 'Jumlah Hari' ]) !!} 
    {!! $errors->first('perkiraan_waktu', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

{!! Form::hidden('id_sprint', $sprint, ['class'=>'form-control']) !!} 


<div class="form-group"> 
  <div class="col-md-4 col-md-offset-2"> 
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary', 'id' => 'btnSubmit']) !!} 
  </div> 
</div>