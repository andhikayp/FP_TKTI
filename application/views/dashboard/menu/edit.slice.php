@extends('layouts.base.app')
@section('title', ' Edit Menu')

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
    <span class="breadcrumb-item active">Edit Menu</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Edit Menu</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-bootstrap px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('MenuController/saveEdit') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $menu->nama_menu }}" required>
                        <label for="username">Nama Menu</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="jumlah" name="jumlah" value="{{ $menu->jumlah }}" required>
                        <label for="username">Jumlah</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="harga" name="harga" value="{{ $menu->harga }}">
                        <label for="username">Harga</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $menu->deskripsi }}">
                        <label for="username">Deskripsi</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="file" class="form-control" id="foto" name="foto">
                        <label for="foto">Upload Foto</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div>
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $menu->id }}">
                    </div>
                </div>
            </div>
            
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('MenuController/index') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection