@extends('layouts.auth.app')
@section('title', 'Masuk')

@section('content')
<div class="bg-image" style="background-image: url({{ base_url('/img/bg_kasir.jpg') }});">
    <div class="row mx-0 bg-black-op">
        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
            <div class="p-30 invisible" data-toggle="appear">
                <p class="font-italic text-white-op">
                    Copyright &copy; <b>Sistem Informasi Kasir </b>Andhika Yoga Perdana (05111740000101) <span class="js-year-copy"></span>
                </p>
            </div>
        </div>
        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
            <div class="content content-full">
                <!-- <div class="px-30 py-10 text-center">
                    <img src="{{ base_url('/img/logo_kasir.png') }}" alt="" width="70%" height="100%"><br><br>
                    <a class="link-effect font-w700" href="index.html">
                        <span class="font-size-xl text-primary-dark">Sistem Informasi Kasir</span> <span class="font-size-xl"><br>Andhika Yoga Perdana</span>
                    </a>
                </div> -->
                <div class="px-30 py-10">
                    <h1 class="h3 font-w700 mt-30 mb-10">Selamat Datang</h1>
                    <h2 class="h5 font-w400 text-muted mb-0">Buat Akun</h2>
                </div>
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
                <form id="login-form" class="js-validation-signin px-30" action="{{ base_url('auth/save') }}" method="post">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                                <label for="loginUsername">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                                <label for="loginUsername">Telepon</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="email" class="form-control" id="email" name="email" required>
                                <label for="loginUsername">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <label for="loginPassword">Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="password" class="form-control" id="" name="" required>
                                <label for="loginPassword">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating open">
                                <select class="form-control pilih_barang" id="role" name="role" required>
                                    <option value="">Login Sebagai: </option>
                                    <option value="Donatur">Donatur</option>
                                    <option value="Mitra">Mitra Pembuat Makanan</option>
                                    <option value="Penerima">Penerima Makanan</option>
                                    <option value="Relawan">Relawan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                            <i class="si si-login mr-10"></i> Simpan
                        </button>
                        <a href="{{ base_url('/') }}" class="btn btn-sm btn-hero btn-alt-success">
                           <i class="si si-login mr-10"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection