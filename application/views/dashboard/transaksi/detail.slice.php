@extends('layouts.base.app')
@section('title', ' Detail Transaksi')

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
    <span class="breadcrumb-item active">Detail Transaksi</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Detail Transaksi</h3>
        <div class="block-options">
            <a href="{{ base_url('TransaksiController/cetak/'.$transaksi[0]->id) }}"><button type="button" class="btn-block-option btn-sm bg-danger text-white">
                <i class="fa fa-print mr-2"></i>Cetak Transaksi
            </button></a>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">ID Transaksi</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $transaksi[0]->id ? $transaksi[0]->id : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Nama Petugas Kasir</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $transaksi[0]->nama ? $transaksi[0]->nama : "-" }}</b></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Waktu Transaksi</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $transaksi[0]->tanggal ? $transaksi[0]->tanggal : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Total Bayar</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $transaksi[0]->total ? $transaksi[0]->total : "-" }}</b></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Harga Satuan</th>
                        <th class="text-center">Harga Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($detail as $data)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $data->nama }}</td>
                        <td class="text-center">{{ $data->jumlah }}</td>
                        <td class="text-center">{{ "Rp " . number_format($data->harga_satuan,2,',','.'); }}</td>
                        <td class="text-center">{{ "Rp " . number_format($data->harga_total,2,',','.'); }}</td>
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
@endsection