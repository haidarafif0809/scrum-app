@extends('layouts.app')

@section('title', 'Dasboard Admin')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12"> 



			
			<div class="col-lg-3 col-xs-4 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-hand-o-right fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<h2 class="huge">{{ $jumlah_assign }}</h2>
								<div>ASSIGN</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-xs-4 col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-check-square fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<h2 class="huge">{{ $jumlah_finish }}</h2>
								<div>FINISH</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-4 col-md-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-pencil-square-o fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<h2 class="huge">{{ $jumlah_backlog }}</h2>
								<div>BACKLOG</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-4 col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-users fa-5x">
								</i>
							</div>
							<div class="col-xs-9 text-right">
								<h2 class="huge">{{ $jumlah_team }}</h2>
								<div>TEAM</div>
							</div>
						</div>
					</div>
				</div>
			</div>




			<div class="col-lg-3 col-xs-4 col-md-6">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-hourglass-start fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<h2 class="huge">
								{{ $jumlah_sprint }}</h2>
								<div>SPRINT</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-xs-4 col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-user-o fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<h2 class="huge">{{ $jumlah_member }}</h2>
								<div>MEMBER</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endsection
