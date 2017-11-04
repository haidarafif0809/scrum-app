@if ($assign == 0)
<a href="{{ $assignUrl }}" class="btn btn-xs btn-primary">Assign</a>
@else
@if ($namaUser != false)
{{ $namaUser }}
@endif
@endif