@if ($assign == 0)
<a href="{{ $assignUrl }}" class="btn btn-xs btn-primary">Assign</a>
@else
@if ($idUser == $user_id)
{!! Form::model($model, ['url' => $unassignUrl, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::submit($namaUser, ['class' => 'btn btn-xs btn-success']) !!}
{!! Form::close() !!}
@else
{!! Form::submit($namaUser, ['class' => 'btn btn-xs btn-default disabled'])!!} 
{!! Form::close() !!}
@endif
@endif