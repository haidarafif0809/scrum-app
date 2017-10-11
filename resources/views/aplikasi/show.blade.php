@extends('layouts.app')

@section('title', 'List Backlog per Aplikasi')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/aplikasi') }}">Aplikasi</a></li>
					<li class="active">List Backlog</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">List Backlog {{ $aplikasi->nama }}</h2>
					</div>
					<div class="panel-body">
						<p>List Backlog{{ $aplikasi->nama }} :</p>
						<table class="table table-condensed table-striped">
							
							@foreach ($listBacklog as $backlog) 
								<ul>
									<li>
										{{ $backlog->nama_backlog }}
									</li>
								</ul>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

