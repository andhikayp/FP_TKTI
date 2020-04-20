@extends('layouts.base.app')
@section('title', ' Manajemen Barang')

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
    <span class="breadcrumb-item active">Manajemen Barang</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Manajemen Barang</h3>
    </div>
    <div class="block-content">
        @if($this->session->user_login['role'] == 1)
            <a href="{{ base_url('BarangController/tambah') }}" class="btn btn-sm bg-earth text-white mb-3"><i class="fa fa-plus mr-2"></i>Tambah Barang</a>
            <a href="{{ base_url('BarangController/tambahStok') }}" class="btn btn-sm btn-secondary mb-3"><i class="fa fa-plus mr-2"></i>Tambah Stok Barang</a>
        @endif
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Harga Beli</th>
                        <th class="text-center">Harga Jual</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Deskripsi</th>
                        @if($this->session->user_login['role'] == 1)
                        <th class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($barang as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="text-center">{{ $data->nama }}</td>
                        <td class="text-center">
                            @if($data->foto)
                                <img src="{{ base_url('img/barang/'.$data->foto) }}" width="100px;" alt="">
                            @else
                                <img src="{{ base_url('img/barang/default.png') }}" width="100px;" alt="">
                            @endif
                        </td>
                        <td class="text-center">{{ $data->kategori }}</td>
                        <td class="text-center">{{ $data->harga_beli }}</td>
                        <td class="text-center">{{ $data->harga_jual }}</td>
                        <td class="text-center">{{ $data->stok }}</td>
                        <td class="text-center">{{ $data->deskripsi }}</td>
                        @if($this->session->user_login['role'] == 1)
                        <td class="text-center" style="min-width: 260px">
                            <span>
                                <a href="{{ base_url('BarangController/editHarga/'.$data->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-refresh mr-2"></i>Edit Harga</a>
                                <button value="{{ base_url('BarangController/deleteBarang/'.$data->id) }}" class="btn btn-sm btn-danger hapus-satu"><i class="fa fa-trash mr-2"></i>Hapus</button>
                            </span>
                        </td>
                        @endif
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