@extends('layouts.app')

@section('title', 'Daftar Backlog')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Backlog</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Backlog</h2>
				</div>
				<div class="panel-body">
					<p> 
						<a class="btn btn-primary" href="{{ route('backlog.create') }}">Tambah</a>
						<a class="btn btn-primary" href="{{ route('export.backlog') }}">Export</a>
						<a class="btn btn-primary" href="{{ route('export.backlog') }}">Export Semua</a>
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