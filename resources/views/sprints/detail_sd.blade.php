@extends('layouts.app')
@section('title', 'Detail Sprint')
@section('content')
<style>
.progress{
    height:30px;
    text-align:center;
    background-color:#DDDDDD;
}
.progress-bar{
    padding:5px;
}
fieldset {
    font-family:sans-serif;
    border:5px solid #1F497D;
    background:#ddd;
    border-radius:5px;
    padding: 15px;
}
fieldset legend {
    color: #fff;
    padding: 5px 10px ;
    font-size: 32px;
    border-radius: 5px;
    box-shadow: 0 0 0 5px #ddd;
}
.font-ini {
    font-size: 22px;
}
/*Animasi*/
#medali{
    background-color:  red;
    width:100px;
    border-radius: 12px;
    text-align: right;
}


</style>
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Dashboard</a></li>
        <li><a href="{{ url('/sprints') }}">Sprint</a></li>
        <li class="active">{{ $nama_sprint->nama_sprint }}</li>
    </ul>

    <fieldset style="min-height:100px;">
        <legend class="bg-primary text-center"><b> Detail sprint "{{ $nama_sprint->nama_sprint }}" </b> </legend>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <i class="fa fa-user"><strong> User Rank</strong></i>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <th>Rank</th>
                                <th>Nama</th>
                                <th>Finish</th>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($user_rank as $name_and_finish)
                                <?php $no++ ?>
                                <tr>
                                    <td><span class="badge badge-secondary">{{ $no }}</span></td>
                                    <td>{{ App\User::select('name')->where('id',$name_and_finish->assign_user_id)->first()->name }}</td>
                                    <td><span>{{ $name_and_finish->jumlah_data }}   </span><i class="fa fa-trophy" style="font-size: 30px;"></i></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <i class="fa fa-hourglass-start"></i><strong> Progress Pencapaian</strong>
                    </div>
                    <div class="panel-body">
                        @if($data_seluruh_sb > 0) {{-- If Satu --}}
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active massive-font" role="progressbar" aria-valuenow="{{ $hasil }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $hasil }}">
                                <p class="font-ini">{{ $hasil }}</p>
                            </div>
                        </div>

                        <br>
                        <div id="animasi-wrapper">
                            @if($hasil == 0) {{-- If Dua --}}
                            <div class="col-md-3">
                                <img width="120" height="120" src="{{ asset('images/belum-mulai.png') }}" class="img-rounded" alt="">
                            </div>
                            <div class="col-md-9">
                                <h3>Kamu belum menyelesaikan satu finish pun! Ayo cepat kerjakan!</h3>
                            </div>
                            @elseif($hasil < 40 && $hasil > 0 ) 
                            <div class="col-md-3">
                                <img width="120" height="120" src="{{ asset('images/mulai.png') }}" class="img-rounded" alt="">
                            </div>
                            <div class="col-md-9">
                                <h3>Progressmu masih dibawah 40%, Ayo kerja keras!</h3>
                            </div>
                            @elseif($hasil > 40 && $hasil < 70)
                            <div class="col-md-3">
                                <img width="120" height="120" src="{{ asset('images/setengah.png') }}" class="img-rounded" alt="">
                            </div>
                            <div class="col-md-9">
                                <h3>Progressmu sudah setengah jalan, Terus konsisten yah!</h3>
                            </div>
                            @elseif($hasil > 70 && $hasil < 99)
                            <div class="col-md-3">
                                <img width="120" height="120" src="{{ asset('images/hampir-selesai.png') }}" class="img-rounded" alt="">
                            </div>
                            <div class="col-md-9">
                                <h3>Hampir selesai!! Ayo lebih semangat!</h3>
                            </div>
                            @elseif($hasil == 100)
                            <div class="col-sm-3">
                             <img width="120" height="120" src="{{ asset('images/selesai.png') }}" class="img-rounded" alt="">
                         </div>
                         <div class="col-md-9">
                            <h3>Good Job! Sprint "<strong>{{ $nama_sprint->nama_sprint }}</strong>" telah kamu selesaikan!</h3>
                        </div>
                        @endif {{-- Akhir If Dua --}}
                    </div>
                    @else
                    <h3><center>{{ $hasil }}</center></h3>
                    @endif {{-- Akhir If Satu --}}

                </div>
            </div>
        </div>
    </div>
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
        <div class="panel panel-info">
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
