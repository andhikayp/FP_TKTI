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
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Pesanan Masuk</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No Pesanan</th>
                        <th class="text-center">Nama Menu</th>
                        <th class="text-center">Jumlah Makanan</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Longlat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($donasi as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="text-center" style="min-width: 150px">{{ $data->kategori }}</td>
                        <td class="" style="min-width: 200px">{{ $data->harga }}</td>
                        <td class="text-center">{{ $data->jumlah_makanan }}</td>
                        <td class="text-center">
                            @if($data->is_verif == 0)
                                Belum Diverifikasi
                            @elseif($data->is_verif == 1)
                                Terverifikasi
                            @endif
                        </td>
                        <td class="text-center" style="min-width: 260px">
                            <span>
                                @if($data->is_verif == 0 and $this->session->user_login['role']=="Admin")
                                <a href="{{ base_url('DonaturController/verifikasi/'.$data->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-refresh mr-2"></i>Verifikasi</a>
                                @endif
                                <button value="{{ base_url('DonaturController/detail_donasi/'.$data->id) }}" class="btn btn-sm btn-danger hapus-satu"><i class="fa fa-trash mr-2"></i>Detail</button>
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