@if ($model->is_verified == 1)

{!! Form::model($model, ['url' => $re_pass_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::submit('reset password', ['class' => 'btn btn-xs btn-primary']) !!}
{!! Form::close() !!}

@else
{!! Form::submit('should confirm', ['class' => 'btn btn-xs btn-default disabled']) !!}
{!! Form::close() !!}

@endif

