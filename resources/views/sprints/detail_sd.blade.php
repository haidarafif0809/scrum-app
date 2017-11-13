@extends('layouts.app')
@section('title', 'Detail Sprint')
@section('content')
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Dashboard</a></li>
        <li><a href="{{ url('/sprints') }}">Sprint</a></li>
        <li class="active">Detail Sprint</li>
    </ul>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading tekks">
                    <i class="fa fa-calendar-times-o"><strong> Not Checkout</strong></i>
                </div>
                <div class="panel-body">
                    <center>
                        <div class="bulet">
                            {{ $jumlah_not_checkout }}
                        </div>
                    </center>
                    <br>
                    <div class="ulli">
                        <ul>
                            @foreach($namaBacklogNC as $nbnc)
                            <li>{{ $nbnc->nama_backlog }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @if($dataNotCheckOut->count() == 0)
                    <center><h3>Tidak Ada Data</h3></center>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading tekks">
                    <i class="fa fa-calendar-check-o"><strong> Checkout</strong></i>
                </div>
                <div class="panel-body">
                    <center>
                        <div class="bulet">
                        {{ $jumlah_checkout }}                       </div>
                    </center>
                    <br>
                    <div class="ulli">
                        <ul>
                            @foreach($namaBacklogC as $nbc)
                            <li>{{ $nbc->nama_backlog }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @if($dataCheckOut->count() == 0)
                    <center><h3>Tidak Ada Data</h3></center>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading tekks">
                    <i class="fa fa-flag-checkered"><strong> Finish</strong></i>
                </div>
                <div class="panel-body">
                    <center>
                        <div class="bulet">
                            {{ $jumlah_finish }}
                        </div>
                    </center>
                    <br>
                    <div class="ulli">
                        <ul>
                            @foreach($namaBacklogF as $nbf)
                            <li>{{ $nbf->nama_backlog }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @if($dataFinish->count() == 0)
                    <center><h3>Tidak Ada Data</h3></center>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection