@if ($assign == 0)
<a href="{{ $assignUrl }}" class="btn btn-xs btn-primary">Assign</a>
@else
{!! Form::model($model, ['url' => $unassignUrl, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::submit($namaUser, ['class' => 'btn btn-xs btn-default']) !!}
{!! Form::close() !!}
@endif