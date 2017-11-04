<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}"> 
  {!! Form::label('template', 'Gunakan template terbaru', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"><br> 
    <a class="btn btn-success" href="{{ route('template.aplikasi') }}"><i class="fa fa-cloud-download"></i> Download</a> 
  </div> 
</div> 
<div class="form-group{{ $errors->has('excel') ? ' has-error' : '' }}"> 
  {!! Form::label('excel', 'Pilih file', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"><br> 
    {!! Form::file('excel', ['class'=>'form-control']) !!} 
    {!! $errors->first('excel', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 
<div class="form-group"> 
  <div class="col-md-4 col-md-offset-2"> 
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!} 
  </div> 
</div>