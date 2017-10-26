{!! Form::model($model, ['url' => $lists_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::submit('List', ['class' => 'btn btn-xs btn-primary']) !!}
{!! Form::close() !!}