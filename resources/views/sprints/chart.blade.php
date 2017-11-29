@extends('layouts.app')
@section('title', 'Burndown')
@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<p class="panel-title text-center">Chart</p>
		</div>
		<div class="panel-body">
			<canvas id="burnChart" class="chartjs" width="undefined" height="undefined"></canvas>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>
	new Chart(document.getElementById("burnChart"),{"type":"line","data":{"labels":["January","February","March","April","May","June","July"],"datasets":[{"label":"Nilai SP","data":{!! json_encode($tes) !!},"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});
</script>
</script>
@endsection
{{--  var data = {
labels: {!! json_encode($authors) !!},
datasets: [{
label: 'Jumlah buku',
data: {!! json_encode($books) !!},
backgroundColor: "rgba(151,187,205,0.5)",
borderColor: "rgba(151,187,205,0.8)",
}]
};
var options = {
scales: {
yAxes: [{
ticks: {
beginAtZero:true,
stepSize: 1
}
}]
}
};
var ctx = document.getElementById("chartPenulis").getContext("2d");
var authorChart = new Chart(ctx, {
type: 'bar',
data: data,
options:--}}