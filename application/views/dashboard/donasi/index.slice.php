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
    <span class="breadcrumb-item active">Manajemen Donasi</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Manajemen Donasi</h3>
    </div>
    <div class="block-content">
        <!-- <a href="{{ base_url('DonaturController/create') }}" class="btn btn-sm bg-earth text-white mb-3"><i class="fa fa-plus mr-2"></i>Tambah Donasi</a> -->
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Jumlah Uang</th>
                        <th class="text-center">Jumlah Makanan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($donasi as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
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
                                <a href="{{ base_url('DonaturController/detail_donasi/'.$data->id) }}" class="btn btn-sm btn-success"><i class="fa fa-cog mr-5"></i>Detail</a>
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
    //disini gak error
    var locations = []
    <?php foreach ($donasi as $data) { ?>
        locations.push({
            lat: <?php echo $data->latitude; ?>,
            lng: <?php echo $data->longitude; ?>,
        });
    <?php } ?>
    console.log(locations)
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