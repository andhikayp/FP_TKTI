@extends('layouts.base.app')
@section('title', ' Upload Bukti Diterima')

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
    <!-- <a class="breadcrumb-item" href="{{ base_url('AdminController/userPetugas') }}">Data Petugas Kasir</a> -->
    <span class="breadcrumb-item active">Upload Bukti Diterima</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Upload Bukti Diterima</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-bootstrap px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('PenerimaController/upload_bukti2') }}" aria-label="">
            <div class="form-group row">    
                <input type="text" class="form-control" id="id_penerima_donasi" name="id_penerima_donasi" value="{{ $penerima_donasi_id }}" hidden>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary input-group">
                        <input type="file" class="form-control" id="bukti" name="bukti">
                        <label for="bukti">Upload Bukti Penerimaan Donasi</label>
                    </div>
                </div>
            </div>
            
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('PenerimaController/riwayat_penerimaan') }}">Cancel</a>&nbsp
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