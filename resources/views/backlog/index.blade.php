@extends('layouts.app')

@section('title', 'Daftar Backlog')

@section('content')
<style>
	.panel-body ul li:hover{
		background-color: #eee;
	}
</style>
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
					<ul class="nav nav-tabs" style="width:100%;margin-bottom: 20px;">
					  <li class="active" style="width:33%">
					  	<a id="tombol-not-checkout" data-toggle="tab" href="#not-checkout">Not Checkout</a>
					  </li>
					  <li style="width:33%">
					  	<a id="tombol-checkout" data-toggle="tab" href="#checkout">Checkout</a>
					  </li>
					  <li style="width:33%">
					  	<a id="tombol-finish" data-toggle="tab" href="#finish">Finish</a>
					  </li>
					</ul>

					<div class="tab-content">
					  <div id="not-checkout" class="tab-pane fade in active">
					    <p>
							<a class="btn btn-primary" href="{{ route('backlog.create') }}" id="tambah-backlog-tour">Tambah</a>
							<a class="btn btn-primary" href="{{ route('export.backlog') }}">Export</a>
							<a class="btn btn-primary" href="{{ route('export.backlog.all') }}">Export All</a>
						</p>
						{!! $html->table(['class'=>'table-striped']) !!}
					  </div>
					  <div id="checkout" class="tab-pane fade">
					  	<p>
							<a class="btn btn-primary" href="{{ route('backlog.create') }}" id="tambah-backlog-tour">Tambah</a>
							<a class="btn btn-primary" href="{{ route('export.backlog') }}">Export</a>
							<a class="btn btn-primary" href="{{ route('export.backlog.all') }}">Export All</a>
						</p>
					    <table id="table-checkout">
					    	<thead>
					    		<tr>
					    			<th>Aplikasi</th>
					    			<th>Nama Backlog</th>
					    			<th>Aksi</th>
					    		</tr>
					    	</thead>
					    </table>
					  </div>
					  <div id="finish" class="tab-pane fade">
					  	<p>
							<a class="btn btn-primary" href="{{ route('backlog.create') }}" id="tambah-backlog-tour">Tambah</a>
							<a class="btn btn-primary" href="{{ route('export.backlog') }}">Export</a>
							<a class="btn btn-primary" href="{{ route('export.backlog.all') }}">Export All</a>
						</p>
					    <table id="table-finish">
					    	<thead>
					    		<tr>
					    			<th>Aplikasi</th>
					    			<th>Nama Backlog</th>
					    			<th>Aksi</th>
					    		</tr>
					    	</thead>
					    </table>
					  </div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
{!! $html->scripts() !!}

<script>
$(function() {

    $(document).on('click','#tombol-checkout',function(){

        $('#table-checkout').DataTable().destroy();
         $('#table-checkout').DataTable({
                processing: true,
                serverSide: true,
                      "ajax": {
                    url: '{{ Url("/table-checkout")}}',
                                "data": function ( d ) {
                         
                              // d.custom = $('#myInput').val();
                              // etc
                          },
                    type:'GET',
                      'headers': {
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      },
                  },
                columns: [
                    { data: 'nama_aplikasi', name: 'nama_aplikasi' },
                    { data: 'nama_backlog', mulai: 'nama_backlog' },
                    { data: 'action', name: 'action' }
                ]
        });
    });
    $(document).on('click','#tombol-finish',function(){

        $('#table-finish').DataTable().destroy();
         $('#table-finish').DataTable({
                processing: true,
                serverSide: true,
                      "ajax": {
                    url: '{{ Url("/table-finish")}}',
                                "data": function ( d ) {
                         
                              // d.custom = $('#myInput').val();
                              // etc
                          },
                    type:'GET',
                      'headers': {
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      },
                  },
                columns: [
                    { data: 'nama_aplikasi', name: 'nama_aplikasi' },
                    { data: 'nama_backlog', mulai: 'nama_backlog' },
                    { data: 'action', name: 'action' }
                ]
        });
    });
});
</script>
@endsection
