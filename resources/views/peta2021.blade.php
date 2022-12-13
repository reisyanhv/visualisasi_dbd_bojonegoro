@extends('sidebar')
@section('title', 'Grafik')

@section('grafik')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<style type="text/css">
    .leaflet-tooltip.no-background{
        background: transparent;
        border:0;
        box-shadow: none;
        font-size:10px;
    }
</style>
@endsection

@section('content')
  <div class="container-fluid py-5">
    <div class="row min-vh-80">
      <div class="col-12">
        <div class="card h-100">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h5 class="text-white text-capitalize ps-3">Peta Risiko {{ $tahun }}</h5>
            </div>
          </div>
          <div class="card-body"> 
            <div class="btn-group dropright">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pilih Tahun
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/peta2018">2018</a></li>
                <li><a class="dropdown-item" href="/peta2019">2019</a></li>
                <li><a class="dropdown-item" href="/peta2020">2020</a></li>
                <li><a class="dropdown-item" href="/peta2021">2021</a></li>
                <li><a class="dropdown-item" href="/peta_prediksi">Prediksi</a></li>
              </ul>
            </div>
            {{-- <img src="../assets/img/peta.jpeg" class="mx-auto d-block"> --}}
            <div id="map" style="height: 440px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script type="text/javascript">
      var peta = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      id: 'mapbox/streets-v11'
    });
      var map = L.map('map', {
          center: [-7.209820, 111.7769293],
          zoom: 10.499,
          layers: [peta] 
      });
      var api = 'http://127.0.0.1:8000/api/cluster2021';
      var dataCluster=[];
      var geojson=[];
      getData();
      function getColor(kluster){
          color="#3f48cc";
          if(kluster==0){
              color="#86FF7E";
          }
          else if(kluster==1){
              color="#FFFF66";
          }
          else if(kluster==2){
              color="#FF0033";
          }
          return color;
      }
      // atur style
      function style(f) {
          var kecamatan=f.properties.kecamatan;
          // console.log(kecamatan);
          result = dataCluster[kecamatan];
          // console.log(result);
          return {
              weight: 0.5,
              opacity: 1,
              color: 'white',
              dashArray: '5',
              fillOpacity: 0.8,
              fillColor: getColor(result.cluster)
          };
      }
      function highlightFeature(e) {
        var layer = e.target;
        layer.setStyle({
              weight: 0.5,
              color: '#f00',
              dashArray: '',
              fillOpacity: 0.8
        });
        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
          layer.bringToFront();
        }
      }
      
      // update info
    function resetHighlight(e) {
      var layer = e.target;
      layer.setStyle({
        weight: 0.5,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.8,
      })
    }
      function onEachFeature(f, layer){
          layer.on({
              mouseover: highlightFeature,
              mouseout: resetHighlight
          });
          var kecamatan= f.properties.kecamatan;
          // console.log(kecamatan);
          data = dataCluster[kecamatan];
          console.log(data);
          var popUp='<table>'+
      			'<tr>'+
      				'<td><h6>'+data.nama_kecamatan+'</h6></td>'+
      			'</tr>'+
            '<tr>'+
      				'<td>Jumlah Kasus : <td>'+data.case+'</td>'+
      			'</tr>'+
            '<tr>'+
      				'<td>Jumlah Meninggal : <td>'+data.death+'</td>'+
      			'</tr>'+
            '<tr>'+
      				'<td>Kepadatan Penduduk : <td>'+data.population_density+'</td>'+
      			'</tr>'+
            '<tr>'+
      				'<td>Jumlah Desa SBS : <td>'+data.desa_sbs+'</td>'+
      			'</tr>'+
            '<tr>'+
      				'<td>Jumlah Desa STBM : <td>'+data.desa_stbm+'</td>'+
      			'</tr>'+
      			'</table>';
          layer.bindPopup(popUp);
          layer.bindTooltip(f.properties['nama'],{
              permanent:true,
              direction:"center",
              className:"no-background"
          });
      }

      function popUp(f,l){
    var out = [];
    if (f.properties){
        for(key in f.properties){
            out.push(key+": "+f.properties[key]);
        }
        l.bindPopup(out.join("<br />"));
    }
}

      function getData(){
  $.ajax({
      url: api,
      dataType:'JSON',
      success:function(data){
          // console.log(data);
          for(i=0;i<data.length;i++){
              var data_cluster = data[i];
              var kec = data_cluster.kecamatan;
              dataCluster[kec]=data_cluster;
              // console.log(data_cluster);
          } 
          // console.log(dataCluster);
          
          $.getJSON("../assets/bojonegoro.geojson", function(data_coordinate){
              // console.log(data_coordinate);
                  for(i=0;i<28;i++){
                  //   console.log(data_coordinate);
                      var kecamatan = data_coordinate.features[i].properties.kecamatan;
                      // console.log(kecamatan);
                  }
                  geojson[kecamatan]= L.geoJSON(data_coordinate,{
                      onEachFeature: onEachFeature,
                      style: style
                  }).addTo(map);
          });
          
      }
  });
  // console.log(dataCluster);
}
        
  </script>
@endsection