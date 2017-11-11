@if ($assign == 0)
Belum di Assign
@else
@if ($finish == 0)
<a href="{{ $finishUrl }}" class="btn btn-xs btn-primary">Finish</a>
@else
{{ $waktu_selesai }}
@endif
@endif