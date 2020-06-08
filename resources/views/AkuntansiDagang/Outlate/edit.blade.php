@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Outlate</h1>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Outlate</h6>
                    <div class="dropdown no-arrow">
                        <a href="{{ url('ubah-outlate/'.$data->id) }}" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-pen fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ url('update-outlate/'. $data->id) }}" method="post" enctype="multipart/form-data">
                        <p>Halaman ini untuk mengubah data profil tentang outlate anda</p>
                        <h5>
                            Nama Bisnis :
                            <input class="form-control" name="nama_bisnis" value="{{ $data->nama_bisnis }}">
                        </h5>
                        <h5>Alamat :
                            <textarea class="form-control" name="alamat">{{ $data->alamat }}</textarea>
                        </h5>
                        <h5>Gambar :
                            <input type="file" class="form-control" name="gambar">
                        </h5>

                        <h5>
                            Latitude :
                            <input type="text" class="form-control" name="latitude" readonly>
                        </h5>
                        <h5>
                            Longitude :
                            <input type="text" class="form-control" name="longtitude" readonly>
                        </h5>
                        <h5>
                        <button type="button" class="btn btn-warning" onclick="get_location()">
                                Cari Koodinat
                        </button>
                        </h5>
                        <p></p>
                        <div class="col-sm-12" id="containers">
                            <div id="mapid" style="height: 500px;"></div>
                        </div>
                        {{ csrf_field() }}
                        <p></p>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#containers').hide();

            get_location = function () {
                $('#containers').show();
                $('#containers2').show();

                var mymap = L.map('mapid').setView([-3.991, 122.51], 13);


                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    maxZoom: 18,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
                }).addTo(mymap);
                var theMarker = {};
                mymap.on('click', function(e) {
                    $('[name="latitude"]').val(e.latlng.lat);
                    $('[name="longtitude"]').val(e.latlng.lng);
                    if (theMarker != undefined) {
                        mymap.removeLayer(theMarker);
                    };

                    //Add a marker to show where you clicked.
                    theMarker = L.marker([e.latlng.lat,e.latlng.lng]).addTo(mymap);
                });
            }
        });

    </script>
@stop