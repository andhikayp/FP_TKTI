@extends('layouts.base.app')
@section('title', ' Tambah User Petugas')

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
    <a class="breadcrumb-item" href="{{ base_url('AdminController/userPetugas') }}">Data</a>
    <span class="breadcrumb-item active">Tambah</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Tambah</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-bootstrap px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('AdminController/saveEdit') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                    @if($siswa->foto)
                        <img src="{{ base_url('img/').$siswa->foto }}" alt="" class="img-fluid rounded mx-auto d-bloc" style="width: 400px;">
                    @else
                        <img src="{{ base_url('img/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc" style="width: 400px;">
                    @endif
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="email" name="email" value="{{ $siswa->email }}" readonly>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $siswa->id }}" readonly hidden>
                        <label for="username">Email</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $siswa->nama }}">
                        <label for="username">Nama</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: hikmawan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $siswa->alamat }}">
                        <label for="username">Alamat</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Jl Ahmad Yani Magelang</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="telp" name="telp" value="{{ $siswa->telp }}">
                        <label for="username">Telepon</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 081252043185</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="password" class="form-control" id="password" name="password">
                        <label for="password">Password</label>
                        <div class="input-group-append">
                            <span class="input-group-text"></span>
                        </div>
                    </div>
                </div>
            </div>
             <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="password" class="form-control" id="repassword" name="repassword">
                        <label for="repassword">Ketik Ulang Password</label>
                        <div class="input-group-append">
                            <span class="input-group-text"></span>
                        </div>
                    </div>
                </div>
            </div> -->
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('AdminController/userPetugas') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection