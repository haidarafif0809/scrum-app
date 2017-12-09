@if ($assign == 0)
Belum di Assign
@else
@if ($idUser == $idUserOnline)
@if ($finish == 0)
@if ($pause == 0)
<a class="btn btn-xs btn-primary" href="{{ $pauseUrl }}">
 Pause
</a>
@else
<a class="btn btn-xs btn-primary" href="{{ $playUrl }}">
 Play
</a>
@endif
<a class="btn btn-xs btn-success" href="{{ $finishUrl }}">
 Finish
</a>
@else
{!! Form::model($model, ['url' => $unFinishUrl, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
{!! Form::submit($waktu_selesai, ['class' => 'btn btn-xs btn-warning']) !!}
{!! Form::close() !!}
@endif
@else
@if ($finish == 0)
Belum selesai
@else
<span class="btn btn-xs btn-default">
 {{ $waktu_selesai }}
</span>
@endif 
@endif
@endif
