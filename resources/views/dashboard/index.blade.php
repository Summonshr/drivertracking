@extends('admin')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-helm icon-gradient bg-love-kiss">
                        </i>
                    </div>
                    <div>
                        Recent activities
                        <div class="page-title-subheading">
                            All drivers associated with 4th Dimension
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Recent activities</h5>
                    <div class="card-content">
                        <table id="driverTable" class="table" data-id-field="code" data-sort-name="value1" data-sort-order="desc" data-show-chart="false" data-pagination="false" data-show-pagination-switch="false">
                            <thead>
                                <tr>
                                    <th size="5">Date</th>
                                    <th> Driver Name</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Time Taken</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th> Load/Unload Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Log::with('user')->latest()->take(100)->get() as $log)
                                <tr>
                                    <td>{{$log->created_at->format('d-m-Y')}}</td>
                                    <td> <a href="{{route('admin.driver.single')}}">{{$log->user->name}}</a></td>
                                    <td>{{$log->created_at->format('h:i A')}}</td>
                                    <td>Depart</td>
                                    <td>00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>1hr</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-8">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Average Time to reach from one location to another</h5>
                        <div class="card-content">
                            <table id="timeTable" class="table" data-id-field="code" data-sort-name="value1" data-sort-order="desc" data-show-chart="false" data-pagination="false" data-show-pagination-switch="false">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th> To</th>
                                        <th>Time Taken</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Port Melbourne</td>
                                        <td> Dandenong</td>
                                        <td>2 hrs</td>

                                    </tr>
                                    <tr>
                                        <td>Port Melbourne</td>
                                        <td> New Aim</td>
                                        <td>2 hrs</td>
                                    </tr>
                                    <tr>
                                        <td>New Aim</td>
                                        <td> Dandenong</td>
                                        <td>2 hrs</td>
                                    </tr>
                                    <tr>
                                        <td> New Aim</td>
                                        <td>Port Melbourne</td>

                                        <td>2 hrs</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Load Unload average time</h5>
                        <div class="card-content">
                            <table id="ULTable" class="table" data-id-field="code" data-sort-name="value1" data-sort-order="desc" data-show-chart="false" data-pagination="false" data-show-pagination-switch="false">
                                <thead>
                                    <tr>
                                        <th>Location</th>
                                        <th> Average Time </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Port Melbourne</td>
                                        <td>2 hrs</td>

                                    </tr>
                                    <tr>
                                        <td> New Aim</td>
                                        <td>2 hrs</td>
                                    </tr>
                                    <tr>
                                        <td> Dandenong</td>
                                        <td>2 hrs</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="map-data">
                    <div id="map"></div>
                    <div class="map-data-checkbox">
                        <div>
                            <input type="checkbox" class="gaucher" id="1" name="gaucher[]" checked onchange="processCheck(this)">
                            <label for="1">Driver</label>
                          </div>
                          <div>
                            <input type="checkbox" class="gaucher" id="2" name="gaucher[]" checked onchange="processCheck(this)">
                            <label for="2">Location</label>
                          </div>
                          
                          <div>
                            <input type="checkbox" class="gaucher" id="3" name="gaucher[]" checked onchange="processCheck(this)">
                            <label for="3">Depot</label>
                          </div>
                          
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    <div class="app-wrapper-footer">
        <div class="app-footer">
            <div class="app-footer__inner bg-white">
                <div class="app-footer-left">
                    <ul class="nav">
                        <li class="nav-item">
                            &copy; 2022 4th Dimension.
                        </li>
                    </ul>
                </div>
                <div class="app-footer-right">
                    <ul class="nav">
                        <li class="nav-item">
                            Build Version: 0.1
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
crossorigin=""></script>
<script>
  





    var driver = {
	type: "FeatureCollection",
	features: [
		{
			type: "Feature",
			properties: {
				popupContent: "Sanjiv",
				popupContentType:"arrived"
			},
			geometry: {
				type: "Point",
				coordinates: [144.93464, -37.831275]
			}
		},
		{
			type: "Feature",
			properties: {
				popupContent: "Pallav",
				popupContentType:"depart"
			},
			geometry: {
				type: "Point",
				coordinates: [144.92464, -37.861275]
			}
		},
		{
			type: "Feature",
			properties: {
				popupContent: "Naren",
				popupContentType:"arrived"
			},
			geometry: {
				type: "Point",
				coordinates: [144.820519,-37.762239]
			}
		},
		{
			type: "Feature",
			properties: {
				popupContent: "Akil",
				popupContentType:"depart"
			},
			geometry: {
				type: "Point",
				coordinates: [144.850519,-37.752239]
			}
		}
	]
};


var depot = {
	type: "FeatureCollection",
	features: [
		{
			type: "Feature",
			properties: {
				popupContent: "Port Melbourne Depot"
			},
			geometry: {
				type: "Point",
				coordinates: [144.92464, -37.831275]
			}
		},
		{
			type: "Feature",
			properties: {
				popupContent: "Dandenong Depot"
			},
			geometry: {
				type: "Point",
				coordinates: [145.240324, -38.004069]
			}
		},
		{
			type: "Feature",
			properties: {
				popupContent: "Narre Warren Depot"
			},
			geometry: {
				type: "Point",
				coordinates: [145.28829, -38.031235]
			}
		},
		{
			type: "Feature",
			properties: {
				popupContent: "Tullamarine Depot"
			},
			geometry: {
				type: "Point",
				coordinates: [144.883376, -37.709021]
			}
		}
	]
};


var locationMarker = {
	type: "FeatureCollection",
	features: [
		{
			type: "Feature",
			properties: {
				popupContent: "New Aim PTY LTD"
			},
			geometry: {
				type: "Point",
				coordinates: [145.041300,-37.844649]
			}
		},
		{
			type: "Feature",
			properties: {
				popupContent: "KMATE Pty Ltd"
			},
			geometry: {
				type: "Point",
				coordinates: [144.850519,-37.762239]
			}
		}
	]
};


var locationIcon = L.icon({
	iconUrl: "https://www.svgrepo.com/show/200165/warehouse-stock.svg",
	iconSize: [15, 20],
	iconAnchor: [16, 37],
	popupAnchor: [0, -28]
});

var driverIcon = L.icon({
	iconUrl: "https://www.svgrepo.com/show/54443/truck.svg",
	iconSize: [20, 28],
	iconAnchor: [16, 37],
	popupAnchor: [0, -28]
});


var map = L.map("map").setView([-37.759841, 145.012974], 09);

	var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            id: 'mapbox.streets'
        }).addTo(map);

	function onEachFeature(feature, layer) {
		
  		var popupContent;
		
	
			
			if(feature.properties.popupContent && feature.properties.popupContentType){
				popupContent += feature.properties.popupContentType;
			}else{
				popupContent += feature.properties.popupContent;
			}
		

		layer.bindPopup(popupContent);
		
		// 	var popupContent= feature.properties.popupContent;
		// layer.bindPopup(popupContent);
	}

	
	var layer1 = L.geoJSON(driver, {
	pointToLayer: function (feature, latlng) {
		return L.marker(latlng, { icon: driverIcon });
	},
	onEachFeature: onEachFeature
}).addTo(map);


	var layer2 =  L.geoJSON(locationMarker, {
	pointToLayer: function (feature, latlng) {
		return L.marker(latlng, { icon: locationIcon });
	},
	onEachFeature: onEachFeature
}).addTo(map);
	var layer3 = L.geoJSON([depot], {
	style: function (feature) {
		return feature.properties && feature.properties.style;
	},

	onEachFeature: onEachFeature,

	pointToLayer: function (feature, latlng) {
		return L.circleMarker(latlng, {
			radius: 8,
			fillColor: "#ff7800",
			color: "#000",
			weight: 1,
			opacity: 1,
			fillOpacity: 0.8
		});
	}
}).addTo(map);


var layers = [layer1, layer2, layer3];

selId = null;

function processCheck(checkbox) {
	var checkId = checkbox.id;

	if (checkbox.checked) {
		layers[checkId - 1].addTo(map);
		selId = checkId;
	} else {
		map.removeLayer(layers[checkId - 1]);
		selId = null;
	}
}


$(document).ready(function() {


var table = $('#driverTable').DataTable({
    select: false,
    "columnDefs": [{
        className: "Name",
        "targets": [0],
        "visible": true,
        "searchable": true
    }]
});
$('input[name="dates"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'), 10)
}, function(start, end, label) {
    var years = moment().diff(start, 'years');
    alert("You are " + years + " years old!");
});



});

</script>

@endsection