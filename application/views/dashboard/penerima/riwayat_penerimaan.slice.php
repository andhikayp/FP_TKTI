@extends('layouts.base.app')
@section('title', ' Riwayat Penerimaan')

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
    <span class="breadcrumb-item active">Riwayat Penerimaan</span>
</nav>
<div class="block-content">
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal Dikirim</th>
                        <th class="text-center">Donatur</th>
                        <th class="text-center">Jumlah Makanan</th>
                        <th class="text-center">Status</th>
                        <!-- <th class="text-center">Total Harga</th> -->
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php $no=1; @endphp
                    @foreach($penerima as $data)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $data->tanggal_donasi }}</td>
                        <td class="text-center">{{ $data->nama }}</td>
                        <td class="text-center">{{ $data->jumlah_makanan }}</td>
                        <td class="text-center">
                            @if($data->bukti)
                                Diterima
                            @elseif($data->flag_kirim == 1)
                                Dalam Perjalanan
                            @elseif($data->flag_kirim == 2)
                                Telah Terkirim
                            @else
                                Belum terkirim
                            @endif
                        </td>
                        <td class="text-center" style="min-width: 260px">
                            <span>
                                <a href="{{ base_url('PenerimaController/detail/'.$data->id) }}" class="btn btn-sm btn-info mr-2"><i class="fa fa-exclamation-circle mr-2"></i>Detail</a>
                            </span>
                            @if($data->bukti == null)
                                <span>
                                    <a href="{{ base_url('PenerimaController/upload_bukti/'.$data->id) }}" class="btn btn-sm btn-success mr-2"><i class="fa fa-exclamation-circle mr-2"></i>Upload Bukti</a>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
                
            </table>
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