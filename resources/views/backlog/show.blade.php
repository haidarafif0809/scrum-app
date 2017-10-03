@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/backlog') }}">Backlog</a></li>
					<li class="active">Detail {{ $backlog->nama_backlog }}</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail {{ $backlog->nama_backlog }}</h2>
					</div>
					<div class="panel-body">
						<p>
							Demo:
							<br>
							{{ $backlog->demo }}
						</p>
						<p>
							Catatan:
							<br>
							{{ $backlog->catatan }}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection