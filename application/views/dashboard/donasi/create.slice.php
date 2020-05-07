@extends('layouts.base.app')
@section('title', ' Tambah Donasi')

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
    <a class="breadcrumb-item" href="{{ base_url('MenuController/daftarMitra') }}">Daftar Mitra</a>
    <a class="breadcrumb-item"  href="" >Menu Makanan</a>
    <!-- <a class="breadcrumb-item" href="{{ base_url('AdminController/userPetugas') }}">Data Petugas Kasir</a> -->
    <span class="breadcrumb-item active">Tambah Donasi</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Tambah Donasi</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-bootstrap px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('DonaturController/posted') }}" aria-label="">
            <div class="form-group row">
                <!-- <div class="col-12">
                    <input type="text" hidden class="form-control" id="user_id" name="user_id" value="{{ $this->session->user_login['id'] }}">
                    <input type="text" hidden class="form-control" id="tanggal_donasi" name="tanggal_donasi" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s"); ?>">
                    
                    <div class="form-material form-material-primary floating open">
                        <select class="form-control pilih_barang" id="kategori" name="kategori" required>
                            <option value="">Kategori </option>
                            <option value="Uang">Uang</option>
                            <option value="Makanan">Makanan</option>
                        </select>
                    </div>
                </div> -->
                <input type="text" class="form-control" id="id_menu" name="id_menu" value="{{ $menu_id }}" hidden>

                 <!-- Jumlah Transfer -->
            <div class="block-content">
                <div class="container">
                    <div class="row mb-10">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <b style="float: right"></style>:</b>
                                    <b>Jumlah Transfer</b>
                                </div>
                                <div class="col-md-7">{{ $jumlah_transfer }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <b style="float: right"></style>:</b>
                                    <b>No Rekening</b>
                                </div>
                                <div class="col-md-7">{{ $mitra->alamat }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary input-group">
                        <input type="file" class="form-control" id="bukti" name="bukti">
                        <label for="bukti">Upload Bukti Transfer</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        <label for="username">Deskripsi</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Ditujukan kepada....</span>
                        </div>
                    </div>
                </div>
<!-- 
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="harga" name="harga">
                        <label for="username">Jumlah Uang {{ $this->session->user_login['nama'] }}</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 1250000. Lakukan Transfer Rekening BNI: 5726725</span>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="jumlah_makanan" name="jumlah_makanan">
                        <label for="username">Jumlah Makanan</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 10</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="" type="text" class="form-control" id="alamat" name="alamat">
                        <label for="alamat">Alamat Donatur</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Desa Rejeni RT 12 RW 06 Krembung-Sidoarjo</span>
                        </div>
                    </div>
                </div>
            </div>       -->
            <!-- <div class="form-group row">
                <div class="col-6">
                    <div class="form-material form-material-primary input-group">
                        <input required="" value="-7.424586942420247" type="text" class="form-control" id="latitude" name="latitude">
                        <label for="sd_uasbn">Latitude</label>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-material form-material-primary input-group">
                        <input required="" value="112.55414313428707" type="text" class="form-control" id="longitude" name="longitude">
                        <label for="sd_nama_siswa">Longitude</label>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary btn-sm" style="height: 100%" onclick="initMap()">Cari</button>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div id="map" style="height: 500px"></div>
                </div>
            </div> -->
             
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('MenuController/daftarMitra') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('moreJS')
<script src="<?php echo base_url(); ?>codebase/src/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){ Codebase.helpers('select2'); });</script>

<script>
    function handleEvent(event) {
        document.getElementById('latitude').value = event.latLng.lat();
        document.getElementById('longitude').value = event.latLng.lng();
    }

    function initMap() {
        var latnya = document.getElementById('latitude').value;
        var longinya = document.getElementById('longitude').value;

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: parseFloat(latnya), lng: parseFloat(longinya)}
        });
        var geocoder = new google.maps.Geocoder();

        var marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: {lat: parseFloat(latnya), lng: parseFloat(longinya)}
        });

        marker.addListener('drag', handleEvent);
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTnAg_gwZ-GQxB6xC0h2cY4TDFYU28ov8&callback=initMap"></script>
@endsection