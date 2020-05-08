@extends('layouts.base.app')
@section('title', ' Profil Petugas')

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
    <span class="breadcrumb-item active">Profil</span>
</nav>
<div class="block block-themed">
    <div class="block-header bg-gd-lake">
        <h3 class="block-title">Profil</h3>
        <div class="block-options">
            <a href="{{ base_url('PetugasController/editProfil/').$petugas->id }}"><button type="button" class="btn-block-option btn-sm bg-danger">
                <i class="si si-pencil"></i> Edit
            </button></a>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-6">
                @if($this->session->user_login['role']!="Mitra")
                <div class="form-group row">
                    <label class="col-12">Foto KTP</label>
                    <div class="col-md-9">
                        @if($petugas->foto_ktp)
                            <!-- <img src="{{ base_url('img/profil/').$petugas->foto }}" alt="" class="img-fluid rounded mx-auto d-bloc"> -->
                            <img src="{{ base_url('img/user/').$petugas->foto_ktp }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @else
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Foto KK</label>
                    <div class="col-md-9">
                        @if($petugas->foto_kk)
                            <!-- <img src="{{ base_url('img/profil/').$petugas->foto }}" alt="" class="img-fluid rounded mx-auto d-bloc"> -->
                            <img src="{{ base_url('img/user/').$petugas->foto_kk }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @else
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @endif
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <label class="col-12">Foto Rumah Tampak Depan</label>
                    <div class="col-md-9">
                        @if($petugas->foto_depan_rumah)
                            <!-- <img src="{{ base_url('img/profil/').$petugas->foto }}" alt="" class="img-fluid rounded mx-auto d-bloc"> -->
                            <img src="{{ base_url('img/user/').$petugas->foto_depan_rumah }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @else
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Email</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->email ? $petugas->email : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Nama</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->nama ? $petugas->nama : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Alamat</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->alamat ? $petugas->alamat : "-" }}( {{ $petugas->longitude ? $petugas->longitude : "-" }}/{{ $petugas->latitude ? $petugas->latitude : "-" }} )</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Telp</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->no_telp ? $petugas->no_telp : "-" }}</b></div>
                    </div>
                </div>
                @if($this->session->user_login['role']!="Mitra")
                <div class="form-group row">
                    <label class="col-12">Jumlah Anggota Keluarga</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->jmlh_anggota_keluarga ? $petugas->jmlh_anggota_keluarga : "-" }}</b></div>
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <label class="col-12">Status</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>
                            {{$petugas->role}} : 
                            @if($petugas->is_verif == 1)
                                Terverifikasi
                            @else 
                                Belum Diverifikasi
                            @endif
                        </b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9">
                        <!-- <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b> -->
                        @if($petugas->is_verif == 0 and $this->session->user_login['role'] == "Admin")
                        <a href="{{ base_url('PetugasController/verifikasi/'.$petugas->id) }}" class="btn btn-sm btn-danger mr-2"><i class="fa fa-refresh mr-2"></i>Verifikasi</a>
                        @endif  
                        </b></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <label class="col-12">Lokasi Tempat Tinggal</label>
                <div id="map" style="height: 500px"></div>
            </div>
        </div>
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
        var latnya = {{ $petugas->latitude }};
        var longinya = {{ $petugas->longitude }};

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