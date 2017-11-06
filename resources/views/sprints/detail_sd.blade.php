@extends('layouts.app')
@section('title', 'Detail Sprint')
@section('content')
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/sprints') }}" class="btn btn-primary btn-xs">Kembali</a></li>
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
                            4
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

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading tekks">
                    <i class="fa fa-calendar-check-o"><strong> Checkout</strong></i>
                </div>
                <div class="panel-body">
                    <center>
                        <div class="bulet">
                            9
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

        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading tekks">
                    <i class="fa fa-flag-checkered"><strong> Finish</strong></i>
                </div>
                <div class="panel-body">
                    <center>
                        <div class="bulet">
                            54
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
@endsection