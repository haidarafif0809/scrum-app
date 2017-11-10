<!-- <a href="{{ $edit_url }}">Ubah</a> -->

{!! Form::model($model, ['url' => $form_url, 'method' => 'delete', 'class' => 'form-inline js-confirm form-hapus-aplikasi', 'data-confirm' => $confirm_message]) !!}
<a href="{{ $edit_url }}" id="btnEdit-{{ $id_team }}" class="btn btn-xs btn-primary">Ubah</a> | {!! Form::submit('Hapus', ['id'=>'btnHapus-'.$id_team,'class' => 'btn btn-xs btn-danger']) !!}
{!! Form::close() !!}