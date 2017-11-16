@extends('layouts.app')
@section('title', 'Detail Sprint')
@section('content')
<style>
.progress{height:30px;text-align:center;background-color:#ffffff;}
.progress-bar {padding:5px;}
fieldset {
    font-family:sans-serif;border:5px solid #1F497D;background:#ddd;border-radius:5px;
    padding: 15px;}
    fieldset legend {
        background: #1F497D;color: #fff;padding: 5px 10px ;
        font-size: 32px;border-radius: 5px;box-shadow: 0 0 0 5px #ddd;margin-left: 20px;}
    </style>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ url('/home') }}">Dashboard</a></li>
            <li><a href="{{ url('/sprints') }}">Sprint</a></li>
            <li class="active">{{ $nama_sprint->nama_sprint }}</li>
        </ul>

        <fieldset style="min-height:100px;">
            <legend><b> Detail sprint "{{ $nama_sprint->nama_sprint }}" </b> </legend>
            @if($data_seluruh_sb > 0)
            <h2><center>Progress Pencapaian</center></h2>
            <hr>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active massive-font" role="progressbar" aria-valuenow="{{ $hasil }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $hasil }}">
                    @if($hasil > 25)
                    <p style="font-size: 22px;">Progress Mencapai {{ $hasil }} </p>
                    @else
                    <p style="font-size: 22px;">{{ $hasil }}</p>
                    @endif
                </div>
            </div>
            @else
            <h3><center>{{ $hasil }}</center></h3>
            @endif
        </fieldset>

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
                                {{ $jumlah_checkout }}                       
                            </div>
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