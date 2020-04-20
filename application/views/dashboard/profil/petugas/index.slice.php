@extends('layouts.base.app')
@section('title', ' Profil Petugas')

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
    <span class="breadcrumb-item active">Profil</span>
</nav>
<div class="block block-themed">
    <div class="block-header bg-gd-lake">
        <h3 class="block-title">Profil</h3>
        <div class="block-options">
            <a href="{{ base_url('PetugasController/editProfil') }}"><button type="button" class="btn-block-option btn-sm bg-danger">
                <i class="si si-pencil"></i> Edit
            </button></a>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Foto KTP</label>
                    <div class="col-md-9">
                        @if($petugas->foto_ktp)
                            <!-- <img src="{{ base_url('img/profil/').$petugas->foto }}" alt="" class="img-fluid rounded mx-auto d-bloc"> -->
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @else
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Foto KK</label>
                    <div class="col-md-9">
                        @if($petugas->foto_kk)
                            <!-- <img src="{{ base_url('img/profil/').$petugas->foto }}" alt="" class="img-fluid rounded mx-auto d-bloc"> -->
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @else
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Foto Rumah Tampak Depan</label>
                    <div class="col-md-9">
                        @if($petugas->foto_depan_rumah)
                            <!-- <img src="{{ base_url('img/profil/').$petugas->foto }}" alt="" class="img-fluid rounded mx-auto d-bloc"> -->
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @else
                            <img src="{{ base_url('img/profil/user.jpeg') }}" alt="" class="img-fluid rounded mx-auto d-bloc">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Email</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->email ? $petugas->email : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Nama</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->nama ? $petugas->nama : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Alamat</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->alamat ? $petugas->alamat : "-" }}( {{ $petugas->longitude ? $petugas->longitude : "-" }}/{{ $petugas->latitude ? $petugas->latitude : "-" }} )</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Telp</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->no_telp ? $petugas->no_telp : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Status</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>
                            {{$petugas->role}} : 
                            @if($petugas->is_verif == 1)
                                Terverifikasi
                            @else 
                                Belum Diverifikasi
                            @endif
                        </b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>
                        @if($petugas->is_verif == 0 and $petugas->role == "Admin")
                        <a href="{{ base_url('PetugasController/verifikasi/'.$petugas->id) }}" class="btn btn-sm btn-danger mr-2"><i class="fa fa-refresh mr-2"></i>Verifikasi</a>
                        @endif  
                        </b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection