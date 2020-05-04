@extends('layouts.base.app')
@section('title', ' Edit Profil Petugas')

@section('sidebar')
    @include('layouts.base.sidebar')
@endsection

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
<style>
  #map {
    height: 100%;
  }
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>
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
    <a class="breadcrumb-item" href="{{ base_url('PetugasController/indexProfil') }}">Profil</a>
    <span class="breadcrumb-item active">Edit Profil</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Edit Profil</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('PetugasController/editProfil') }}" aria-label="">
            <!-- <div class="form-group row">
                @if($petugas->foto_ktp)
                    <img src="{{ base_url('img/profil/').$petugas->foto }}" alt="" class="img-fluid rounded mx-auto d-bloc" style="width: 400px;">
                    <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc" style="width: 400px;">
                @else
                    <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc" style="width: 400px;">
                @endif
            </div> -->
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->nama }}" type="text" class="form-control" id="nama" name="nama" readonly>
                        <label for="nama">Nama</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Hikmawan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->email }}" type="text" class="form-control" id="email" name="email" readonly>
                        <label for="email">Email</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: hikmawan@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->no_telp }}" type="text" class="form-control" id="telp" name="telp">
                        <label for="telp">Nomer Telepon</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 085850000000</span>
                        </div>
                    </div>
                </div>
            </div>
            @if($this->session->user_login['role']=="Penerima")
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->no_telp }}" type="text" class="form-control" id="jmlh_anggota_keluarga" name="jmlh_anggota_keluarga">
                        <label for="telp">Jumlah Anggota Keluarga</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 2</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($this->session->user_login['role']!="Mitra")
            <div>
                <div class="col-12">
                    <div class="form-material form-material-primary input-group">
                        <input type="file" class="form-control" id="file[]" name="file[]">
                        <label for="repassword">Upload Foto KTP</label>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <div class="form-material form-material-primary input-group">
                        <input type="file" class="form-control" id="file[]" name="file[]">
                        <label for="repassword">Upload Foto KK</label>
                    </div>
                </div>
            </div>
            @endif
            <div>
                <div class="col-12">
                    <div class="form-material form-material-primary input-group">
                        <input type="file" class="form-control" id="file[]" name="file[]">
                        <label for="repassword">
                            @if($this->session->user_login['role']=="Mitra")
                                Upload Foto Depan Rumah Makan / Toko / Perusahaan
                            @else
                                Upload Foto Depan Rumah
                            @endif
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->alamat }}" type="text" class="form-control" id="alamat" name="alamat">
                        <label for="alamat">Alamat</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Desa Rejeni RT 12 RW 06 Krembung-Sidoarjo</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
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
            </div>

            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('PetugasController/indexProfil') }}">Cancel</a>&nbsp
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