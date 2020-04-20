@extends('layouts.base.app')
@section('title', ' Edit Harga')

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
    <a class="breadcrumb-item" href="{{ base_url('BarangController/index') }}">Data Barang</a>
    <span class="breadcrumb-item active">Edit Harga</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Edit Harga</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-bootstrap px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('BarangController/saveHarga') }}" aria-label="">
            <input type="text" class="form-control" id="id" name="id" value="{{ $barang->id }}" hidden>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}" readonly>
                        <label for="username">Nama Barang</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Indomie</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="{{ $barang->harga_beli }}">
                        <label for="username">Harga Beli</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 8000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="{{ $barang->harga_jual }}">
                        <label for="username">Harga Jual</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 9000</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('BarangController/index') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection