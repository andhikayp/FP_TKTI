@extends('layouts.base.app')
@section('title', ' Detail Menu')

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
    <a class="breadcrumb-item" href="{{ base_url('MenuController/index') }}">Data Menu</a>
    <span class="breadcrumb-item active">Detail Menu</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Detail Menu</h3>
        <!-- <div class="block-options">
            <a href="{{ base_url('MenuController/cetak/'.$transaksi[0]->id) }}"><button type="button" class="btn-block-option btn-sm bg-danger text-white">
                <i class="fa fa-print mr-2"></i>Cetak Transaksi
            </button></a>
        </div> -->
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Nama Menu</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $menu->nama_menu }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Jumlah</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $menu->jumlah }}</b></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Harga</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $menu->harga }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Deskripsi</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $menu->deskripsi }}</b></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <label class="col-12">Foto Makanan</label>
                <div class="col-md-9">
                    <div class="form-control-plaintext">
                        <img src="<?php echo '/img/menu/'.$menu->foto_menu; ?>" alt="" srcset="">
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
</script>
@endsection