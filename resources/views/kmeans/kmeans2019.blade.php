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
    /*Legend specific*/
.legend {
  padding: 6px 8px;
  font: 14px Arial, Helvetica, sans-serif;
  background: white;
  background: rgba(255, 255, 255, 0.8);
  /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
  /*border-radius: 5px;*/
  line-height: 24px;
  color: #555;
}
.legend h4 {
  text-align: center;
  font-size: 16px;
  margin: 2px 12px 8px;
  color: #777;
}

.legend span {
  position: relative;
  bottom: 3px;
}

.legend i {
  width: 18px;
  height: 18px;
  float: left;
  margin: 0 8px 0 0;
  opacity: 0.7;
}

.legend i.icon {
  background-size: 18px;
  background-color: rgba(255, 255, 255, 1);
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
              <h5 class="text-white text-capitalize ps-3">Peta K-Means {{ $tahun }}</h5>
            </div>
          </div>
          <div class="card-body"> 
            <div class="btn-group dropright">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pilih Tahun
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/kmeans2018">2018</a></li>
                <li><a class="dropdown-item" href="/kmeans2019">2019</a></li>
                <li><a class="dropdown-item" href="/kmeans2020">2020</a></li>
                <li><a class="dropdown-item" href="/kmeans2021">2021</a></li>
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
      var api = 'http://127.0.0.1:8000/api/kmeans2019';
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
/*Legend specific*/
var legend = L.control({ position: "bottomleft" });

legend.onAdd = function(map) {
  var div = L.DomUtil.create("div", "legend");
  div.innerHTML += "<h4>Legenda</h4>";
  div.innerHTML += '<i style="background: #86FF7E"></i><span>Rendah</span><br>';
  div.innerHTML += '<i style="background: #FFFF66"></i><span>Sedang</span><br>';
  div.innerHTML += '<i style="background: #FF0033"></i><span>Tinggi</span><br>';
  
  return div;
};

legend.addTo(map);
        
  </script>
@endsection