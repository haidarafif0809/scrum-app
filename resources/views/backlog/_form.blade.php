<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
 {!! Form::label('aplikasi_id', 'Aplikasi', ['class'=>'col-md-2 control-label']) !!}
 <div class="col-md-4" id="backlog-pilih-aplikasi-tour">
  {!! Form::select('aplikasi_id', [''=>'']+App\Aplication::pluck('nama','id')->all(), null, ['class' => 'form-control js-selectize-reguler', 'placeholder' => 'Pilih Aplikasi', 'id' => 'aplikasi_id']) !!}
    {!! $errors->first('aplikasi_id', '
  <p class="help-block">
   :message
  </p>
  ') !!}
 </div>
</div>
<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
 {!! Form::label('nama_backlog', 'Nama Backlog', ['class'=>'col-md-2 control-label']) !!}
 <div class="col-md-4">
  {!! Form::text('nama_backlog', null, ['class'=>'form-control', 'id'=>'nama-backlog-tour']) !!}
    {!! $errors->first('nama_backlog', '
  <p class="help-block">
   :message
  </p>
  ') !!}
 </div>
</div>
<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
 {!! Form::label('demo', 'Demo', ['class'=>'col-md-2 control-label']) !!}
 <div class="col-md-10" id="demo-backlog-tour">
  {!! Form::textarea('demo', null, ['class'=>'form-control', 'size' => '20x2']) !!}
    {!! $errors->first('demo', '
  <p class="help-block">
   :message
  </p>
  ') !!}
 </div>
</div>
<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
 {!! Form::label('catatan', 'Catatan', ['class'=>'col-md-2 control-label']) !!}
 <div class="col-md-4">
  {!! Form::textarea('catatan', null, ['class'=>'form-control', 'size' => '10x2','id'=>'catatan-backlog-tour']) !!}
    {!! $errors->first('catatan', '
  <p class="help-block">
   :message
  </p>
  ') !!}
 </div>
</div>
<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
 {!! Form::label('sprint', 'Sprint', ['class'=>'col-md-2 control-label']) !!}
 <div class="col-md-4" id="backlog-pilih-sprint-tour">
  {!! Form::select('sprint_id', [''=>'']+App\Sprint::pluck('nama_sprint','id')->all(), null, ['class' => 'form-control js-selectize-reguler', 'placeholder' => 'Pilih Sprint', 'id' => 'sprint_id']) !!}
    {!! $errors->first('sprint_id', '
  <p class="help-block">
   :message
  </p>
  ') !!}
 </div>
</div>
<div id="inputanSprint">
</div>
<div class="form-group">
 <div class="col-md-4 col-md-offset-2" id="simpanBacklog">
  {!! Form::submit('Simpan', ['class'=>'btn btn-primary', 'id' => 'buton']) !!}
 </div>
</div>
