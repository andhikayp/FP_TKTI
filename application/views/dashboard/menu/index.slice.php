@extends('layouts.base.app')
@section('title', ' Menu Makanan')

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
    <span class="breadcrumb-item active">Menu Makanan</span>
</nav>
<div class="block">
    <!-- Profil Mitra -->
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Profil Mitra</h3>
    </div>

    <div class="block-content">
        <div class="container">
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <b style="float: right"></style>:</b>
                            <b>Nama</b>
                        </div>
                        <div class="col-md-7">{{ $mitra->nama }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Alamat</b>
                        </div>
                        <div class="col-md-7">{{ $mitra->alamat }}</div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Email</b>
                        </div>
                        <div class="col-md-7">{{ $mitra->email }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <b style="float: right"></style>:</b>
                            <b>Telepon</b>
                        </div>
                        <div class="col-md-7">{{ $mitra->no_telp }}</div>
                    </div>
                </div>
            </div>
            <hr>

           
        </div>
    </div>

    <!-- Menu -->
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Menu Makanan</h3>
    </div>
    <div class="block-content">
        @if($this->session->user_login['role'] == "Mitra")
        <a href="{{ base_url('MenuController/tambah') }}" class="btn btn-sm bg-earth text-white mb-3"><i class="fa fa-plus mr-2"></i>Tambah Menu</a>
        @endif
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Menu</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Harga</th>
                        <!-- <th class="text-center">Total Harga</th> -->
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($menu as $data)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $data->nama_menu }}</td>
                        <td class="text-center">{{ $data->jumlah }}</td>
                        
                        <!-- <td class="text-center">{{ $data->tanggal }}</td> -->
                        <td class="text-center">
                            @if($this->session->user_login['role'] == "Donatur")
                            {{ "Rp " . number_format(105/100*$data->harga,2,',','.'); }}
                            @else
                            {{ "Rp " . number_format($data->harga,2,',','.'); }}
                            @endif
                        </td>
                        <td class="text-center" style="min-width: 260px">
                            <span>
                                <a href="{{ base_url('MenuController/detail/'.$data->id) }}" class="btn btn-sm btn-info mr-2"><i class="fa fa-exclamation-circle mr-2"></i>Detail</a>
                                @if($this->session->user_login['role'] == "Donatur")
                                <a href="{{ base_url('DonaturController/create/'.$data->id) }}" class="btn btn-sm btn-warning mr-2"><i class="fa fa-pencil mr-2"></i>Pesan</a>
                                @endif
                                @if($this->session->user_login['role'] == "Mitra")
                                <a href="{{ base_url('MenuController/edit/'.$data->id) }}" class="btn btn-sm btn-warning mr-2"><i class="fa fa-pencil mr-2"></i>Edit</a>
                                <button value="{{ base_url('MenuController/deleteMenu/'.$data->id) }}" class="btn btn-sm btn-danger hapus-satu"><i class="fa fa-trash mr-2"></i>Hapus</button>
                                @endif
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

<script>
    $(".hapus-satu").click(function(){
        var link = ($(this).val())
        swal({
            title: 'Apakah anda yakin untuk menghapus barang ini?',
            text: "Data barang akan hilang setelah anda menekan tombol 'Ya'",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            closeOnConfirm: true
            }).then((result) => {
            if (result.value) {
                window.location.href = link;
            }
            });
    });
</script>
@endsection