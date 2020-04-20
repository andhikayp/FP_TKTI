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
                <div class="px-30 py-10 text-center">
                    <img src="{{ base_url('/img/logo_kasir.png') }}" alt="" width="70%" height="100%"><br><br>
                    <a class="link-effect font-w700" href="index.html">
                        <span class="font-size-xl text-primary-dark">Sistem Informasi Kasir</span> <span class="font-size-xl"><br>Andhika Yoga Perdana</span>
                    </a>
                </div>
                <div class="px-30 py-10">
                    <h1 class="h3 font-w700 mt-30 mb-10">Selamat Datang</h1>
                    <h2 class="h5 font-w400 text-muted mb-0">Masuk terlebih dahulu</h2>
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
                <form id="login-form" class="js-validation-signin px-30" action="{{ base_url('auth/dologin') }}" method="post">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="email" class="form-control" id="loginUsername" name="loginUsername" required>
                                <label for="loginUsername">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
                                <label for="loginPassword">Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                            <i class="si si-login mr-10"></i> Masuk
                        </button>
                        <!-- <button type="" class="btn btn-sm btn-hero btn-alt-primary"> -->
                          <a href="{{ base_url('Auth/register') }}" class="btn btn-sm btn-hero btn-alt-success">
                             <i class="si si-login mr-10"></i> Buat Akun
                          </a>
                        <!-- </button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection