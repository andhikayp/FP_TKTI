@extends('layouts.base.app')
@section('title', ' Daftar Penerima Bantuan')

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
    <span class="breadcrumb-item active">Daftar Penerima Bantuan</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Daftar Penerima Bantuan</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">No Telp</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Jumlah Menerima Makanan</th>
                        <!-- <th class="text-center">Status</th> -->
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($penerima as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="text-center" style="min-width: 150px">{{ $data->nama }}</td>
                        <td class="text-center">{{ $data->no_telp }}</td>
                        <td class="text-center">{{ $data->alamat }}</td>
                        <td class="text-center">{{ $data->jmlh_terima_makanan }}</td>
                        <!-- <td class="text-center">
                            @if($data->status == 0)
                                Pending
                            @elseif($data->status == 1)
                                Mengirim
                            @elseif($data->status == 2)
                                Diterima
                            @endif
                        </td> -->
                        <td class="text-center">
                            <span>
                                <a href="{{ base_url('DonaturController/detail_penerima/'.$data->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-refresh mr-2"></i>Detail</a>
                                <!-- @if($data->status == 1)
                                <a href="{{ base_url('DonaturController/terima/'.$data->id) }}" class="btn btn-sm btn-danger mr-2"><i class="fa fa-refresh mr-2"></i>Terima</a>
                                @endif -->
                                <!-- <button value="{{ base_url('AdminController/deleteUser/'.$data->id) }}" class="btn btn-sm btn-danger hapus-satu"><i class="fa fa-trash mr-2"></i>Hapus</button> -->
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