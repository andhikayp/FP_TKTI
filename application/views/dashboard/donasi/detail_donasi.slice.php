@extends('layouts.base.app')
@section('title', ' Detil Donasi')

@section('sidebar')
    @include('layouts.base.sidebar')
@endsection

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
<div class="col-12 mb-2 mt-2">
    @if($this->session->flashdata('message')) 
        @if($this->session->flashdata('message')['type'] == 'error')
        <div class="alert alert-danger">
            {{ implode('\n', $this->session->flashdata('message')['message']) }}
        </div>
        @else
        <div class="alert alert-success">
            {{ implode('\n', $this->session->flashdata('message')['message']) }}
        </div>
        @endif
    @endif
</div>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ base_url('/') }}">Dashboard</a>
    <a class="breadcrumb-item" href="">Peserta Luar Kota dan Tahun Lalu</a>
    
    <span class="breadcrumb-item active">lol</span>
</nav>
<div class="block block-themed">
    <div class="block-header bg-gd-lake">
        <h3 class="block-title">Detil Donasi</h3>
    </div>
    <div class="block-content">
        <div class="container">
            @if($this->session->user_login['role']=="Admin")
            <h3>Data Donatur</h3>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <b style="float: right"></style>:</b>
                            <b>Nama</b>
                        </div>
                        <div class="col-md-7">wkw</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Alamat</b>
                        </div>
                        <div class="col-md-7">wkwk</div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Telepon</b>
                        </div>
                        <div class="col-md-7">wkw</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Kecamatan</b>
                        </div>
                        <div class="col-md-7">wkwk</div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Longitude</b>
                        </div>
                        <div class="col-md-7">
                            wkwk
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Kelurahan</b>
                        </div>
                        <div class="col-md-7">wkwk</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Latitude</b>
                        </div>
                        <div class="col-md-7">wkwkw</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>RT / RW</b>
                        </div>
                        <div class="col-md-7">wkwk</div>
                    </div>
                </div>
            </div>
            <hr>
            @endif
            <h3>Donasi</h3>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Mitra</b>
                        </div>
                        <div class="col-md-7">
                            wkwk
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Menu Makanan</b>
                        </div>
                        <div class="col-md-7">
                            wkwk
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Harga</b>
                        </div>
                        <div class="col-md-7">
                            wkwk
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Bukti Transfer</b>
                        </div>
                        <div class="col-md-7">
                            wkwk
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Status</b>
                        </div>
                        <div class="col-md-7">
                            wkwk
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <h3>Pengiriman</h3>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Nama Relawan</b>
                        </div>
                        <div class="col-md-7">
                            wkw
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Alamat</b>
                        </div>
                        <div class="col-md-7">
                            wkw
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Telepon</b>
                        </div>
                        <div class="col-md-7">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Progres pengiriman</b>
                        </div>
                        <div class="col-md-7">
                            <a style="color: #3f9ce8 !important;" href="" target="_blank">lol</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Penerima Makanan</h3>
            <div class="table-responsive">
                <table id="table-ruang" class="stripe table table-stripped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Telepon</th>
                            <th class="text-center">Jumlah Makanan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($penerima as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td class="text-center" style="min-width: 150px">{{ $data->nama }}</td>
                            <td class="" style="min-width: 200px">{{ $data->alamat }}</td>
                            <td class="text-center">{{ $data->no_telp }}</td>
                            <td class="text-center">
                                
                            </td>
                            <td class="text-center" style="min-width: 260px">
                                
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <h3>Lokasi Detail Penerima Makanan</h3>
            <div class="form-group row">
                <div class="col-12">
                    <div id="map" style="height: 500px"></div>
                </div>
            </div>
            <!-- <h3>Lokasi</h3>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Kecamatan</b>
                        </div>
                        <div class="col-md-7">lol</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Kelurahan/Desa</b>
                        </div>
                        <div class="col-md-7">lol</div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>RT / RW</b>
                        </div>
                        <div class="col-md-7">lol</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Latitude dan Longitude</b>
                        </div>
                        <div class="col-md-7"><a style="color: #3f9ce8 !important;" href="" target="_blank">lol</a></div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Alamat Lengkap</b>
                        </div>
                        <div class="col-md-7">lol</div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection
@section('moreJS')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#table-ruang').DataTable({
            "autoWidth": true,
            "ordering": false,
        });
    });
</script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: {lat: -28.024, lng: 140.887}
        });

        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length]
          });
        });

        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }

    var locations = [
            {lat: -31.563910, lng: 147.154312},
            {lat: -33.718234, lng: 150.363181},
            {lat: -33.727111, lng: 150.371124},
            {lat: -33.848588, lng: 151.209834},
            {lat: -33.851702, lng: 151.216968},
            {lat: -34.671264, lng: 150.863657},
            {lat: -35.304724, lng: 148.662905},
            {lat: -36.817685, lng: 175.699196},
            {lat: -36.828611, lng: 175.790222},
            {lat: -37.750000, lng: 145.116667},
            {lat: -37.759859, lng: 145.128708},
            {lat: -37.765015, lng: 145.133858},
            {lat: -37.770104, lng: 145.143299},
            {lat: -37.773700, lng: 145.145187},
            {lat: -37.774785, lng: 145.137978},
            {lat: -37.819616, lng: 144.968119},
            {lat: -38.330766, lng: 144.695692},
            {lat: -39.927193, lng: 175.053218},
            {lat: -41.330162, lng: 174.865694},
            {lat: -42.734358, lng: 147.439506},
            {lat: -42.734358, lng: 147.501315},
            {lat: -42.735258, lng: 147.438000},
            {lat: -43.999792, lng: 170.463352}
          ]
    console.log(locations)
</script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTnAg_gwZ-GQxB6xC0h2cY4TDFYU28ov8&callback=initMap"></script>
@endsection