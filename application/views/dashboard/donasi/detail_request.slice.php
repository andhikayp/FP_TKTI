@extends('layouts.base.app')
@section('title', ' Detail Permintaan')

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
    <span class="breadcrumb-item active">Detail Permintaan</span>
</nav>
<div class="block block-themed">
    <div class="block-header bg-gd-lake">
        <h3 class="block-title">Profil</h3>
        <!-- <div class="block-options">
            <a href="{{ base_url('requestController/editProfil') }}"><button type="button" class="btn-block-option btn-sm bg-danger">
                <i class="si si-pencil"></i> Edit
            </button></a>
        </div> -->
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Penerima</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $penerima->nama ? $penerima->nama : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Donatur</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>
                            @if($donatur)
                                {{ $donatur->nama}}
                            @else
                                -
                            @endif
                            </b>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Pengirim</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>
                            @if($pengirim)
                                {{ $pengirim->nama}}
                            @else
                                -
                            @endif
                        </b></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Jumlah Makanan</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $request->jumlah_makanan ? $request->jumlah_makanan : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Alamat</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $request->alamat ? $request->alamat : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Longitude, Latitude</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $request->longitude ? $request->longitude : "-" }} , {{ $request->latitude ? $request->latitude : "-" }}</b></div>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-12">Telp</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $request->no_telp ? $request->no_telp : "-" }}</b></div>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label class="col-12">Status</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>
                            @if($request->status == 0)
                                Pending
                            @elseif($request->status == 1)
                                Mengirim
                            @else 
                                Diterima
                            @endif
                        </b></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label class="col-12">Lokasi Pengiriman</label>
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
        var latnya = {{ $request->latitude }};
        var longinya = {{ $request->longitude }};

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