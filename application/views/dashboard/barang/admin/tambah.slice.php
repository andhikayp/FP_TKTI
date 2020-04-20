@extends('layouts.base.app')
@section('title', ' Tambah Barang')

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
    <span class="breadcrumb-item active">Tambah Barang</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Tambah Barang</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-bootstrap px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('BarangController/saveBarang') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="nama" name="nama">
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
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi Barang"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating open">
                        <select class="form-control" id="kategori" name="kategori">
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach($kategori as $t)
                                <option value="{{ $t->nama }}">{{ $t->nama }}</option>
                            @endforeach
                        </select>
                        <label for="kategori">Kategori</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="harga_beli" name="harga_beli">
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
                        <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                        <label for="username">Harga Jual</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 9000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="stok" name="stok">
                        <label for="stok">Stok</label>
                        <div class="input-group-append">
                            <span class="input-group-text"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <label for="repassword">Upload Foto</label>
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