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
    <span class="breadcrumb-item active">Detail Donasi</span>
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
                        <div class="col-md-7">{{ $donatur->nama }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Alamat</b>
                        </div>
                        <div class="col-md-7">{{ $donatur->alamat }}</div>
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
                        <div class="col-md-7">{{ $donatur->no_telp }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Longitude, Latitude</b>
                        </div>
                        <div class="col-md-7">
                            {{ $donatur->longitude }} | {{ $donatur->latitude }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <hr>
            <h3>Donasi</h3>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Mitra</b>
                        </div>
                        <div class="col-md-7">
                         {{ $mitra->nama }}
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
                            {{ $menu->nama_menu }}
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
                        {{ $donasi->harga }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Jumlah Makanan</b>
                        </div>
                        <div class="col-md-7">
                            {{ $menu->jumlah }}
                        </div>
                    </div>
                </div>
            </div>
            @php
                $longlat = (string)$donasi->latitude.','.(string)$donasi->longitude;
            @endphp
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Alamat</b>
                        </div>
                        <div class="col-md-7">
                        {{ $donasi->alamat }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Longitude | Latitude</b>
                        </div>
                        <div class="col-md-7">
                            {{ $donasi->longitude }} | {{ $donasi->latitude }} 
                            <span class="" style="float: right;"><a href="https://www.google.com/maps/place/{{ $longlat }}" target="_blank">[Periksa Alamat]</a></span>
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
                        @if($donasi->status_donasi == 0)
                            Pending
                        @elseif($donasi->status_donasi == 1)
                            Pesanan Sedang Dibuat
                        @elseif($donasi->status_donasi == 2)
                            Pesanan Ditolak
                        @elseif($donasi->status_donasi == 3)
                            Pesanan Sedang Diantar
                        @else
                            Pengiriman Selesai Dilakukan
                        @endif
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
                         <img style="max-width:100px;" src="{{ base_url('img/folder_bukti/'.$donasi->bukti) }}">
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
                        {{ $relawan->nama }}
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
                        {{ $relawan->alamat }}
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
                        {{ $relawan->no_telp }}
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
                            <a style="color: #3f9ce8 !important;" href="" target="_blank">{{ $progres }} %</a>
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
                            <th class="text-center">No Telp</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Jumlah Menerima Makanan</th>
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
                            <td class="text-center">{{ $data->telp }}</td>
                            <td class="text-center">{{ $data->alamat }}</td>
                            <td class="text-center">{{ $data->jumlah_makanan }}</td>
                            <td class="text-center">
                                @if($data->bukti)
                                    Diterima
                                @elseif($data->flag_kirim == 1)
                                    Dalam Perjalanan
                                @elseif($data->flag_kirim == 2)
                                    Telah Terkirim
                                @else
                                    Belum terkirim
                                @endif
                            </td>
                            <td class="text-center">
                                @if($data->flag_kirim == 0 & $this->session->user_login['role'] == "Relawan")
                                <span>
                                    <a href="{{ base_url('DonaturController/flag_kirim/'.$data->id.'/1') }}" class="btn btn-sm btn-danger mr-2 mb-2"><i class="fa fa-send mr-2"></i>Kirim</a>
                                </span>
                                @endif
                                @if($data->flag_kirim == 1 & $this->session->user_login['role'] == "Relawan")
                                <span>
                                    <a href="{{ base_url('DonaturController/flag_kirim/'.$data->id.'/2') }}" class="btn btn-sm btn-success mr-2 mb-2"><i class="fa fa-check mr-2"></i>Serahkan</a>
                                </span>
                                @endif
                                <span>
                                    <a href="{{ base_url('DonaturController/detail_penerima/'.$data->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-refresh mr-2"></i>Detail</a>
                                </span>
                            </td>
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

    var locations = []
    var labels = []
    i = 1;
    <?php foreach ($penerima as $data) { ?>
        locations.push({
            lat: parseFloat("<?php echo $data->latitude; ?>"),
            lng: parseFloat("<?php echo $data->longitude; ?>"),
        });
        labels.push(i.toString());
        i++;
    <?php } ?>
</script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: -7.4469817, lng: 112.6959943}
        });
        var markers = locations.map(function(location, i) {
            return new google.maps.Marker({
                position: location,
                label: labels[i]
            });
        });
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }
</script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTnAg_gwZ-GQxB6xC0h2cY4TDFYU28ov8&callback=initMap"></script>
@endsection