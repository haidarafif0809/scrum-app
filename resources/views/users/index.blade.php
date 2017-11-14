@extends('layouts.app')

@section('title', 'Daftar Member')

@section('content')
<div class="modal fade" id="detail" 
tabindex="-1" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" 
			data-dismiss="modal" 
			aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h2 class="modal-title" 
			id="favoritesModalLabel"><i class="fa fa-user-circle-o fa-spin fa-1x fa-fw" aria-hidden="true"></i>Detail User</h2>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading tekks">
							<i class="fa fa-calendar-times-o"><strong> Not Checkout</strong></i>
						</div>
						<div class="panel-body">
							<center>
								<div class="bulet">
								</div>
							</center>
							<br>
							<div class="ulli">
								<ul>
									<li>Contoh Detail Sprint</li>
									<li>Contoh Detail Sprint</li>
									<li>Contoh Detail Sprint</li>
									<li>Contoh Detail Sprint</li>
									<li>Contoh Detail Sprint</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<button type="button" 
			class="btn btn-default" 
			data-dismiss="modal">Close</button>
			<!-- <span class="pull-right">
				<button type="button" class="btn btn-primary">
					Add to Favorites
				</button>
			</span> -->
		</div>
	</div>
</div>
</div>

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
						<a class="btn btn-info" href="{{ url('/admin/users/create') }}">Tambah Member</a>
						<a class="btn btn-info" href="{{ url('/admin/export/users') }}">Export</a>
						<a class="btn btn-info" href="{{ route('exportAll.users.post') }}">Export All</a>
					</p>

					{!! $html->table(['class'=>'table-striped table-user']) !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

{!! $html->scripts() !!}
@endsection

