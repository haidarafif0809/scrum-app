@if ($model->is_verified == 0)

{!! Form::model($model, ['url' => $konfirmasi_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::submit('Ya', ['class' => 'btn btn-xs btn-success']) !!}
{!! Form::close() !!}

@else
{!! Form::model($model, ['url' => $konfirmasi_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_messages]) !!}
{!! Form::submit('Tidak', ['class' => 'btn btn-xs btn-danger']) !!}
{!! Form::close() !!}
@endif

