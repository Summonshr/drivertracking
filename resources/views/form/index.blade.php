<!doctype html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Drivers form fill</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="antialiased">
    <div id="onload" class="loader-active">
        <div id="stage" class="loader-spinner"></div>
    </div>

    <div class="app-container app-theme-grey">
        <div class="login-container driver-clockin">
            <div class="map-video">
                <div id="map" style="height: 500px"></div>
                <div class="video-section">
                    <video id="player" autoplay="true" class="video-wrapper"></video>
                    <button id="capture" class="btn hide btn-danger">Capture</button>
                    <br>
                    <canvas id="snapshot"></canvas>
                </div>
            </div>
            <div class="driver-form-section">
                <form x-data="{load_type: ''}" class="needs-validation mb-3" action="{{url('resource')}}" method="post">
                    @csrf
                    <input type="hidden" name="image" value="{{old('image')}}">
                    <input type="hidden" name="resource_type" value="log">
                    <div class="form-group row">
                        <div class="clockin-design">
                            <div class="form-check form-check-inline selecotr-item">
                                <input class="form-check-input selector-item_radio" type="radio" name="type"
                                    @checked(old('type')=='arrived' ) id="inlineRadio3" required value="arrived"
                                    checked>
                                <label class="form-check-label selector-item_label" for="inlineRadio3">ARRIVED</label>
                            </div>
                            <div class="form-check form-check-inline selecotr-item">
                                <a class="btn break-button btn-toggle selector-item_label" href="{{url('/break')}}">
                                    <span class="d-show">BREAK</span>
                                </a>
                            </div>
                            <div class="form-check form-check-inline selecotr-item">
                                <input class="form-check-input selector-item_radio" type="radio" name="type"
                                    @checked(old('type')=='depart' ) id="inlineRadio4" required value="depart">
                                <label class="form-check-label selector-item_label" for="inlineRadio4">DEPART</label>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label font-weight-bold">SELECT LOCATION</label>

                            <div class="col-md-7">
                                <select class="form-control" required name="location_id" id="selectLocation">
                                    <option value="">Select an option</option>
                                    @foreach(\App\Models\Location::all() as $location)
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-5">
                                <label class="col-form-label font-weight-bold">LOAD/UNLOAD</label>
                            </div>

                            <div class="col-7">
                                <div class="switch-field">
                                    <input x-model="load_type" type="radio" id="radio-one" name="load_type" value="Load"
                                        checked />
                                    <label for="radio-one">LOAD</label>
                                    <input x-model="load_type" type="radio" id="radio-two" name="unload_type"
                                        value="unload" />
                                    <label for="radio-two"> UNLOAD</label>
                                </div>
                            </div>
                        </div>
                        <template x-if="load_type">
                            <div class="load-action row">
                                <div class="form-group col-6">
                                    <label class=" col-form-label font-weight-bold"> CAGE</label>
                                    <div class="">
                                        <input type="number" class="form-control" id="validationCustom01" min='1'
                                            value="0" name="cage" placeholder="Number of load cage" required="">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label font-weight-bold"> PALLET</label>
                                    <div class="">
                                        <input type="number" class="form-control" id="validationCustom01" min='1'
                                            value="0" name="pallet" placeholder="Number of load palette" required="">
                                    </div>

                                </div>
                            </div>
                        </template>
                        <input type="submit" onclick="return checkIfAllOk()" class="btn btn-danger" value="Submit">
                    </div>
                </form>
            </div>



        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.min.js"
        integrity="sha512-Atu8sttM7mNNMon28+GHxLdz4Xo2APm1WVHwiLW9gW4bmHpHc/E2IbXrj98SmefTmbqbUTOztKl5PDPiu0LD/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
    } else {
        alert("Geolocation is not supported by this browser");
    }

    function success(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        getMap(latitude, longitude);
    }

    function error() {
        alert("Unable to retrieve location");
    }
    const myIcon = L.icon({
        iconUrl: 'https://unpkg.com/leaflet@1.8.0/dist/images/marker-icon.png',
    });

    function getMap(latitude, longitude) {
        const map = L.map("map").setView([latitude, longitude], 16);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
        L.marker([latitude, longitude], {
            icon: myIcon
        }).addTo(map);
    }

    function checkIfAllOk() {
        with(document.forms[0]) {
            if (image.value === '') {
                document.getElementById('capture').click()
                return false;
            }
        }
    }
    var player = document.getElementById("player");
    var snapshotCanvas = document.getElementById("snapshot");
    var captureButton = document.getElementById("capture");
    var handleSuccess = function(stream) {
        // Attach the video stream to the video element and autoplay.
        player.srcObject = stream;
    };

    function handleVideo(stream) {
        video.src = window.URL.createObjectURL(stream);
    }

    if (captureButton) captureButton.addEventListener("click", function() {
        var context = snapshot.getContext("2d");
        // Draw the video frame to the canvas.
        context.drawImage(
            player,
            0,
            0,
            snapshotCanvas.width,
            snapshotCanvas.height
        );
        document.forms[0].image.value = context.canvas.toDataURL()
    });
    navigator.mediaDevices.getUserMedia({
        video: true
    }).then(handleSuccess);


    $(document).ready(function() {
        $("#onload").hide();

    });
    </script>
</body>

</html>
