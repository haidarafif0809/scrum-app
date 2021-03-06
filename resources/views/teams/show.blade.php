@extends('layouts.app')

@section('title', 'Detail Team')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/teams') }}">Team</a></li>
				<li class="active">Anggota Team</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Anggota {{ $team->nama_team }}</h2>
				</div>

				<div class="panel-body">
					<p>Anggota {{ $team->nama_team }} :</p>
					<table class="table table-condensed table-striped">
						<tbody>
							<div class="ulli">
								<ul>
									@foreach ($anggotaTeam as $teams)
									<li>{{ $teams->user->name }}</li>
									@endforeach
								</ul>
							</div>
						</tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

