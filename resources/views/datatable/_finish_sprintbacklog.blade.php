@if ($assign == 0)
Belum di Assign
@else
@if ($idUser == $idUserOnline)
@if ($finish == 0)
<a href="{{ $finishUrl }}" class="btn btn-xs btn-primary">Finish</a>
@else
{!! Form::model($model, ['url' => $unFinishUrl, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::submit($waktu_selesai, ['class' => 'btn btn-xs btn-warning']) !!}
{!! Form::close() !!}
@endif
@else
@if ($finish == 0)
Belum selesai
@else
<span class="btn btn-xs btn-default">{{ $waktu_selesai }}</span>
@endif 
@endif
@endif