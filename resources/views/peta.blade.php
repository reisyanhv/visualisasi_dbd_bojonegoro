@extends('sidebar')
@section('title', 'Grafik')
@section('content')
  <div class="container-fluid py-5">
    <div class="row min-vh-80">
      <div class="col-12">
        <div class="card h-100">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h5 class="text-white text-capitalize ps-3">Peta Risiko</h5>
            </div>
          </div>
          <div class="card-body"> 
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown button
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
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
          center: [	-7.1524786, 111.8869293],
          zoom: 11.4,
          layers: [peta] 
      });
      var api = 'http://127.0.0.1:8000/api/cluster2018';
      var dataCluster=[];
      var geojson=[];
      getData();
      function getColor(kluster){
          color="#3f48cc";
          if(kluster==1){
              color="#3bdb63";
          }
          else if(kluster==2){
              color="#fafa43";
          }
          else if(kluster==3){
              color="#ff2121";
          }
          return color;
      }
      // atur style
      function style(f) {
          var kecamatan=f.properties.kecamatan;
          result = dataCluster[kecamatan];
          console.log(result.cluster);
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
          data = dataCluster[kecamatan];
          // console.log(data);
          // var popUp='<table>'+
      // 			'<tr>'+
      // 				'<td colspan="4"><h6>'+data.kecamatan+'</h6></td>'+
      // 			'</tr>'+
      // 			'</table>';
      // layer.bindPopup(popUp);
          layer.bindTooltip(f.properties['kecamatan'],{
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
          for(i=0;i<data.length;i++){
              var data_cluster = data[i];
              var kec = data_cluster.kecamatan;
              dataCluster[kec]=data_cluster;
              // console.log(data_cluster);
          }      
          
          $.getJSON("{{asset('assets')}}/bojonegoro.geojson", function(data_coordinate){
                  for(i=0;i<28;i++){
                    // console.log(data_coordinate);
                      var kecamatan = data_coordinate.features[i].properties.kecamatan;
                      // console.log(kecamatan);
                  }
                  geojson[kecamatan]=L.geoJSON(data_coordinate,{
                      onEachFeature: onEachFeature,
                      style: style
                  }).addTo(map);
          });
          
      }
  });
}
        
  </script>
@endsection