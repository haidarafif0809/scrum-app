@extends('layouts.app')

@section('title', 'Dasboard Admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-retweet"></span>
                    <strong>Backlog</strong>
                </div>
                    <div class="panel-body">
                    Jumlah                      
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading"><span class="glyphicon glyphicon-credit-card"></span>
                    <strong>Team</strong>
                </div>
                    <div class="panel-body">
                    Jumlah 
                </div>
            </div>
        </div>



        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading"><span class="glyphicon glyphicon-object-align-left"></span>
                    <strong>Sprint</strong>
                </div>
                    <div class="panel-body">
                    Jumlah Sprint
                </div>
            </div>
        </div>

       
        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading"><span class="glyphicon glyphicon-edit"></span>
                    <strong>Member</strong>
                </div>
                    <div class="panel-body">
                    Jumlah Member
                </div>
            </div>
        </div>

    </div>
</div>
@endsection