@if ($assign == 0)
<a href="{{ $assignUrl }}" class="btn btn-xs btn-primary">Assign</a>
@else
@if ($idUser == $idUserOnline)
{!! Form::model($model, ['url' => $unAssignUrl, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::submit('Batalkan Assign', ['class' => 'btn btn-xs btn-warning']) !!}
{!! Form::close() !!}
@else
{!! Form::submit($namaUser, ['class' => 'btn btn-xs btn-default'])!!} 
@endif
@endif