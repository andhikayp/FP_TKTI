@extends('layouts.base.app')
@section('title', ' Detil Penerima Bantuan')

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
    <span class="breadcrumb-item active">Detail Penerima Bantuan</span>
</nav>
<div class="block block-themed">
    <div class="block-header bg-gd-lake">
        <h3 class="block-title">Detil Penerima Bantuan</h3>
    </div>
    <div class="block-content">
    <h3>Data Penerima Bantuan</h3>
        <div class="container">
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Nama</b>
                        </div>
                        <div class="col-md-7">
                            {{ $penerima->nama }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>No Telepon</b>
                        </div>
                        <div class="col-md-7">
                        {{ $penerima->no_telp }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Alamat</b>
                        </div>
                        <div class="col-md-7">
                        {{ $penerima->alamat }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Email</b>
                        </div>
                        <div class="col-md-7">
                        {{ $penerima->email }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Jumlah Anggota Keluarga</b>
                        </div>
                        <div class="col-md-7">
                        {{ $penerima->jmlh_anggota_keluarga }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Jumlah Makanan Diterima</b>
                        </div>
                        <div class="col-md-7">
                        {{ $penerima->jumlah_makanan }}
                        </div>
                    </div>
                </div>
            </div>
            <h3>File Pendukung Penerima Bantuan</h3>
            <div class="row mb-10">
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-md-12">
                           <img src="{{ base_url('img/user/'.$penerima->foto_ktp) }}">
                           <div><b>Foto KTP</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-md-12">
                           <img src="{{ base_url('img/user/'.$penerima->foto_kk) }}">
                           <div><b>Foto Kartu Keluarga</b></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-md-12">
                           <img src="{{ base_url('img/user/'.$penerima->foto_depan_rumah) }}">
                           <div><b>Foto Depan Rumah</b></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @if($penerima->bukti)
            <h3>Bukti Penerimaan Makanan</h3>
            <div class="row mb-10">
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-md-12">
                           <img src="{{ base_url('img/user/'.$penerima->bukti) }}">
                           <div><b>Foto Bukti</b></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTnAg_gwZ-GQxB6xC0h2cY4TDFYU28ov8&callback=initMap"></script>
@endsection