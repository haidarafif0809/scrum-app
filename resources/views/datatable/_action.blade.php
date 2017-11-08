<!-- <a href="{{ $edit_url }}">Ubah</a> -->

{!! Form::model($model, ['url' => $form_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}
<a href="{{ $edit_url }}" id="btnEdit-{{ $id_aplikasi }}" class="btn btn-xs btn-primary">Ubah</a> | {!! Form::submit('Hapus', ['class' => 'btn btn-xs btn-danger']) !!}
{!! Form::close() !!}