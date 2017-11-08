@extends('layouts.app')

@section('title', 'List Backlog per Aplikasi')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/aplikasi') }}">Aplikasi</a></li>
				<li class="active">List Backlog</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">List Backlog <b>{{ $aplikasi->nama }} :</b></h2>
				</div>
				<div class="panel-body">
					<table class="table table-condensed table-striped">		
						<div class="ulli">
							<ul>
								@foreach ($listBacklog as $backlog)
								<li>
									{{ $backlog->nama_backlog }}
								</li>
								@endforeach
							</ul>
						</div>
						@if ($listBacklog->count() == 0)
						<h4 >"<strong>{{$aplikasi->nama}}</strong>" belum memiliki backlog!.</h4>
						@endif
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

