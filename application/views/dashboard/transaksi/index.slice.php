@extends('layouts.base.app')
@section('title', ' Manajemen Transaksi')

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
    <span class="breadcrumb-item active">Manajemen Transaksi</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Manajemen Transaksi</h3>
    </div>
    <div class="block-content">
        <a href="{{ base_url('TransaksiController/tambah') }}" class="btn btn-sm bg-earth text-white mb-3"><i class="fa fa-plus mr-2"></i>Tambah Transaksi</a>
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">ID Transaksi</th>
                        <th class="text-center">Nama Petugas Kasir</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Total Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($transaksi as $data)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $data->id }}</td>
                        @if($this->session->user_login['role'] == 1)
                            <td class="text-center">{{ $data->nama }}</td>
                        @elseif($this->session->user_login['role'] == 2)
                            <td class="text-center">{{ $this->session->user_login['nama'] }}</td>
                        @endif
                        <td class="text-center">{{ $data->tanggal }}</td>
                        <td class="text-center">{{ "Rp " . number_format($data->total,2,',','.'); }}</td>
                        <td class="text-center" style="min-width: 260px">
                            <span>
                                <a href="{{ base_url('TransaksiController/detail/'.$data->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-refresh mr-2"></i>Detail</a>
                                <!-- <button value="{{ base_url('TransaksiController/deleteBarang/'.$data->id) }}" class="btn btn-sm btn-danger hapus-satu"><i class="fa fa-trash mr-2"></i>Hapus</button> -->
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