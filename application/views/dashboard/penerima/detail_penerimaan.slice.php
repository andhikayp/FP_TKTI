@extends('layouts.base.app')
@section('title', ' Detil Penerimaan Donasi')

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
    <a class="breadcrumb-item" href="{{ base_url('PenerimaController/riwayat_penerimaan') }}">Riwayat Penerimaan</a>
    <span class="breadcrumb-item active" href="">Detail Penerimaan Donasi</span>
    
</nav>
<div class="block block-themed">
    <div class="block-header bg-gd-lake">
        <h3 class="block-title">Detil Penerimaan Donasi</h3>
    </div>
    <div class="block-content">
        <div class="container">
            <h3>Donatur</h3>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Donatur</b>
                        </div>
                        <div class="col-md-7">
                         {{ $donatur->nama }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Email Donatur</b>
                        </div>
                        <div class="col-md-7">
                            {{ $donatur->email }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>No Telepon</b>
                        </div>
                        <div class="col-md-7">
                            {{ $donatur->no_telp }}
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6">
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
                        @endif
                        </div>
                    </div>
                </div> -->
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

            <h3>Donasi</h3>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Tanggal Dikirim</b>
                        </div>
                        <div class="col-md-7">
                        {{ $donasi->tanggal_donasi }}
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
                            <b>Jumlah Makanan yang Diterima</b>
                        </div>
                        <div class="col-md-7">
                        {{ $penerima_donasi->jumlah_makanan }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Pesan Dari Donatur</b>
                        </div>
                        <div class="col-md-7">
                        {{ $donasi->deskripsi }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @if($penerima_donasi->bukti != null)
            <h3 class="text-center">Bukti Diterima</h3>
            <div class="row mb-10">
                <img class="rounded mx-auto d-block img-fluid text-center" style="max-width:150px;" src="{{ base_url('img/folder_bukti/'.$penerima_donasi->bukti) }}">
            </div>
            <hr>
            @endif
            <div class="row mb-10">
                <div class="col-md-12">
                    <div class="form-group row">
                        @if($penerima_donasi->bukti)
                            <button class="btn-block btn-success btn-lg col-md-12">Diterima</button>
                        @elseif($penerima_donasi->flag_kirim == 1)
                        <button class="btn-block btn-warning btn-lg col-md-12">Dalam Perjalanan</button>
                        @else
                        <button class="btn-block btn-danger btn-lg col-md-12">Belum terkirim</button>
                        @endif
                        </button>
                    </div>
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
<!-- <script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTnAg_gwZ-GQxB6xC0h2cY4TDFYU28ov8&callback=initMap"></script> -->
@endsection