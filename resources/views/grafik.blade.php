@extends('sidebar')
@section('title', 'Grafik')

@section('grafik')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable({{ Js::from($result) }});

    var options = {
      chart: {
        title: 'Grafik Jumlah Risiko Kasus Demam Berdarah Bojonegoro',
        // subtitle: 'Risiko dari tahun 2018 - 2020'
      },
      colors: ['green','yellow', 'red']
    };

    var chart = new google.charts.Bar(document.getElementById('barchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
@endsection

@section('content')
  <div class="container-fluid py-5">
    <div class="row min-vh-80">
      <div class="col-12">
        <div class="card h-100">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h5 class="text-white text-capitalize ps-3">Grafik</h5>
            </div>
          </div>
          <div class="card-body text-center">
            {{-- <img src="../assets/img/grafik-batang2.jpg" class="mx-auto d-block"> --}}
            <div id="barchart_material" style="width: 900px; height: 500px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection