<div class="form-group{{ $errors->has('tanggal_mulai') ? ' has-error' : '' }}"> 
  {!! Form::label('tanggal_mulai', 'Tanggal Mulai', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::text('tanggal_mulai', null,  array('class' => 'form-control', 'id' => 'datepicker')) !!} 
    {!! $errors->first('tanggal_mulai', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 


<div class="form-group{{ $errors->has('durasi') ? ' has-error' : '' }}"> 
  {!! Form::label('durasi', 'Durasi', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::select('durasi',  ['1 Minggu' => '1 Minggu', '2 Minggu'=>'2 Minggu', '3 Minggu'=>'3 Minggu'] ,  null, ['class'=>'form-control js-selectize', 'id' => 'durasi_waktu' ]) !!} 
    {!! $errors->first('durasi', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

<div class="form-group{{ $errors->has('waktu_mulai') ? ' has-error' : '' }}"> 
  {!! Form::label('waktu_mulai', 'Waktu Mulai', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::text('waktu_mulai', null,  array('class' => 'form-control', 'id' => 'timepicker')) !!} 
    {!! $errors->first('waktu_mulai', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

<div class="form-group {!! $errors->has('team_id') ? 'has-error' : '' !!}">
  {!! Form::label('team_id', 'Team', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::select('team_id', [''=>'']+App\Team::pluck('nama_team','id')->all(), null, ['class'=>'form-control js-selectize-reguler', 'placeholder' => '--PILIH TEAM--','id'=>'team_id']) !!}
    {!! $errors->first('team_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('kode_sprint') ? ' has-error' : '' }}"> 
  {!! Form::label('kode_sprint', 'Kode Sprint', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::text('kode_sprint', null,  array('class' => 'form-control', 'id' => 'timepicker')) !!} 
    {!! $errors->first('kode_sprint', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

<div class="form-group{{ $errors->has('nama_sprint') ? ' has-error' : '' }}"> 
  {!! Form::label('nama_sprint', 'Nama Sprint', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::text('nama_sprint', null, ['class'=>'form-control']) !!} 
    {!! $errors->first('nama_sprint', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

<div class="form-group{{ $errors->has('nilai_sp') ? ' has-error' : '' }}"> 
  {!! Form::label('nilai_sp', 'Nilai SP', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::text('nilai_sp', null, ['class'=>'form-control']) !!} 
    {!! $errors->first('nilai_sp', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

<div class="form-group{{ $errors->has('goal') ? ' has-error' : '' }}"> 
  {!! Form::label('goal', 'goal', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
   {!! Form::textarea('goal', null, ['class'=>'form-control', 'size' => '20x3']) !!} 
   {!! $errors->first('goal', '<p class="help-block">:message</p>') !!} 
 </div> 
</div> 


<div class="form-group"> 
  <div class="col-md-4 col-md-offset-2"> 
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!} 
  </div> 
</div>