@extends('layouts.app')

@section('title', 'Daftar Member')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Data Member</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Data Member</h2>
				</div>
				<div class="panel-body">

					<p>
						<a class="btn btn-info" href="{{ url('users/create') }}">Tambah Member</a>
						<a class="btn btn-info" href="{{ url('export/users') }}">Export</a>
						<a class="btn btn-info" href="{{ route('exportAll.users.post') }}">Export All</a>
					</p>

					{!! $html->table(['class'=>'table-striped']) !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
{!! $html->scripts() !!}
@endsection

