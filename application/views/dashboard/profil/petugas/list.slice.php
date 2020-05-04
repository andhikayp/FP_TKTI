@extends('layouts.base.app')
@section('title', ' Manajemen User')

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
    <span class="breadcrumb-item active">Manajemen User</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Manajemen User</h3>
    </div>
    <div class="block-content">
        <a href="{{ base_url('PetugasController/tambahUser') }}" class="btn btn-sm bg-earth text-white mb-3"><i class="fa fa-plus mr-2"></i>Tambah User</a>
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Telepon</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($donasi as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="text-center" style="min-width: 150px">{{ $data->nama }}</td>
                        <td class="text-center">{{ $data->email }}</td>
                        <td class="text-center">{{ $data->no_telp }}</td>
                        <td class="text-center" style="min-width: 200px">{{ $data->alamat }}</td>
                        <td class="text-center">{{ $data->role }}</td>
                        <td class="text-center">
                            @if($data->is_verif == 0)
                                Belum Diverifikasi
                            @elseif($data->is_verif == 1)
                                Terverifikasi
                            @endif
                        </td>
                        <td class="text-center" style="width: 100%;">
                            <span>
                                <a href="{{ base_url('PetugasController/indexProfil/'.$data->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-refresh mr-2"></i>Detail</a>
                                <button style="margin-top:2%;" value="{{ base_url('PetugasController/deleteUser/'.$data->id) }}" class="btn btn-sm btn-danger hapus-satu"><i class="fa fa-trash mr-2"></i>Hapus</button>
                                @if($data->is_verif == 0)
                                <a  style="margin-top:2%;" href="{{ base_url('PetugasController/verifikasi/'.$data->id) }}" class="btn btn-sm btn-success mr-2"><i class="fa fa-refresh mr-2"></i>Verifikasi</a>
                                @endif
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
            title: 'Apakah anda yakin untuk menghapus petugas kasir ini?',
            text: "Data petugas kasir akan hilang setelah anda menekan tombol 'Ya'",
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