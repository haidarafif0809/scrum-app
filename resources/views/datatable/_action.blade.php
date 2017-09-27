<<<<<<< HEAD
<!-- <a href="{{ $edit_url }}">Ubah</a> -->

{!! Form::model($model, ['url' => $form_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
	<a href="{{ $edit_url }}" class="btn btn-xs btn-primary">Ubah</a> | {!! Form::submit('Hapus', ['class' => 'btn btn-xs btn-danger']) !!}
{!! Form::close() !!}
=======
{!! Form::model($model, ['url' => $form_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] ) !!}
<a href="{{ $edit_url }}" class="btn btn-xs btn-primary">Ubah</a> |
{!! Form::submit('Hapus', ['class'=>'btn btn-xs btn-danger']) !!}
{!! Form::close()!!}
>>>>>>> 6f1938d9071a31fb6044adbd632a8528e165040e
