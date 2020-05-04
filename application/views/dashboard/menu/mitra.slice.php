@extends('layouts.base.app')
@section('title', ' Daftar Mitra')

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
    <span class="breadcrumb-item active">Daftar Mitra</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Daftar Mitra</h3>
    </div>
</div>
<div class="row invisible" data-toggle="appear">
    @foreach($mitra as $data)
    <div class="col-md-4" style="">
        <div class="block">
            <div class="block-content block-content-full">
                <div class="py-20 text-center">
                    <div class="mb-20">
                        <!-- <i class="fa fa-envelope-open fa-4x text-primary"></i> -->
                        <img src="{{ base_url('img/profil/b.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <!-- .$data->foto_depan_rumah -->
                    <div class="font-size-h4 font-w600">{{ $data->nama }}</div>
                    <div class="text-muted">{{ $data->alamat }}</div>
                    <div class="text-muted">{{ $data->no_telp }}</div>
                    <div class="pt-20">
                        <a class="btn btn-rounded btn-alt-primary" href="{{ base_url('MenuController/index/').$data->id }}">
                            <i class="fa fa-cog mr-5"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
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