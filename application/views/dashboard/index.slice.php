@extends('layouts.base.app')
@section('title', ' Dashboard')

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
    <a class="breadcrumb-item" href="#">Dashboard</a>
    <span class="breadcrumb-item active">Index</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Selamat Datang di Dashboard</h3>
    </div>
    <div class="block-content">
        @if($this->session->user_login['role']=="Admin")
        <div><b>Jumlah User</b></div>
        <div class="content content-full" id="itungan">
            <div class="row visible" data-toggle="appear">
                <!-- Row #1 -->
                <div class="col-6 col-xl-3">
                    <a class="block block-link-rotate block-transparent text-right bg-primary-light" href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="si si-users fa-3x text-primary"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $donatur->jumlah }}">0</div>
                            <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Donatur</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-link-rotate block-transparent text-right bg-success-light" href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="si si-users fa-3x text-primary"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-primary-darker"><span data-toggle="countTo" data-speed="1000" data-to="{{ $mitra->jumlah }}">0</span></div>
                            <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Mitra</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-link-rotate block-transparent text-right bg-info-light" href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="si si-users fa-3x text-primary"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $relawan->jumlah }}">0</div>
                            <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Relawan</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-link-rotate block-transparent text-right bg-danger-light  " href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="si si-users fa-3x text-primary"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $penerima->jumlah }}">0</div>
                            <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Penerima</div>
                        </div>
                    </a>
                </div>
                <!-- END Row #1 -->
            </div>
        </div>
        <hr>
        <div><b>Sebaran Penerima Makanan</b></div>
        <div class="content content-full" id="itungan">
            <div class="form-group row">
                <div class="col-12">
                    <div id="map" style="height: 500px"></div>
                </div>
            </div>
        </div>
        @elseif($this->session->user_login['role']=="Mitra")
        <div>
            <p>
            <h3>Mitra Rumah Makan</h3>
            Apa saja yang dapat anda lakukan dan anda dapatkan di aplikasi SIMARAK ini sebagai Mitra Kerjasama dalam berbagi kebermanfaatan?<br><br>
	        <h5>Tugas Mitra</h5>
            Mitra Rumah Makan membuat makanan berdasarkan permintaan dari admin. Apabila makanan sudah jadi maka akan diambil oleh relawan dan didistribusikan kepada penerima makanan<br><br> 

            <h5>Notifikasi</h5>
            Mitra Rumah Makan akan mendapatkan notifikasi apabila sistem memilih akun penerima tersebut sebagai penerima makanan.<br><br>

            <h5>Poin dan Hadiah</h5>
            Mitra Rumah Makan akan mendapatkan tambahan poin jika berpartisipasi dalam aplikasi ini, dan dapat ditukar dengan berbagai hadiah seperti berbagai macam voucher (Ditukarkan pada merchant).<br><br>

            </p>
        </div>
        @elseif($this->session->user_login['role']=="Penerima")
        <div>
        <p>
            <h3>Penerima Makanan</h3>
            Apa saja yang dapat anda lakukan dan anda dapatkan di aplikasi SIMARAK ini sebagai penerima makanan?<br><br>
            <h5>Meminta makanan</h5>
            Pengguna yang ingin meminta makanan dapat mendaftarkan diri sebagai penerima makanan. Pengguna harus memasukkan lokasi, foto depan rumah, jumlah yang ingin diminta, serta dana keluarga sesuai jumlah makanan yang diminta. <br><br>
            <h5>Notifikasi</h5>
            Penerima akan mendapatkan notifikasi apabila sistem memilih akun penerima tersebut sebagai penerima makanan.<br><br>
            <h5>Melakukan Konfirmasi</h5>
            Penerima makanan melakukan konfirmasi bahwa makanan telah diterima dengan menekan tombol “makanan telah diterima”.<br><br>
            <h5>Poin dan Hadiah</h5>
            Penerima makanan akan mendapatkan tambahan poin jika berpartisipasi dalam aplikasi ini, dan dapat ditukar dengan berbagai hadiah seperti berbagai macam voucher (Ditukarkan pada merchant).<br><br>
        </p>
        </div>
        @elseif($this->session->user_login['role']=="Donatur")
        <div>
            <p>
                <h3>Donatur</h3>
                Apa saja yang dapat anda lakukan dan anda dapatkan di aplikasi SIMARAK ini sebagai donatur dalam berbagi kebermanfaatan?<br><br>
                <h5>Donasi Makanan</h5> 
                Donatur dapat mendonasikan makanan dengan mengisi form “donasi makanan” pada aplikasi. Form berisi alamat, foto, deskripsi, waktu donasi makanan dan jumlah makanan yang akan dikirimkan. Disediakan 2 opsi untuk donatur dalam memberikan donasinya: mengirim makanan secara langsung atau menggunakan jasa relawan yang mengantarkan makanannya. Jika menggunakan jasa relawan maka relawan tersebut akan mengambil makanan dan mendistribusikannya kepada para penerima.<br><br> 
                <h5>Donasi uang</h5> 
                Donatur juga dapat mendonasikan uang untuk biaya operasional. Biaya operasional ditujukan untuk para relawan yang berperan penting dalam pendistribusian makanan. Jika jumlah uang melebihi biaya operasional, maka akan dibelikan makanan melalui mitra kerjasama untuk kemudian didistribusikan.<br><br>
                <h5>Lokasi Penerima</h5>
                Donatur dapat mengetahui tujuan donasi makanan diberikan. Donatur dapat melihat lokasi penerima donasi.<br><br>
                <h5>Notifikasi</h5>
                Donatur akan mendapatkan notifikasi apabila donasi sudah diterima oleh penerima makanan.<br><br>
                <h5>Poin dan Hadiah</h5>
                Donatur akan mendapatkan tambahan poin jika berpartisipasi dalam aplikasi ini, dan dapat ditukar dengan berbagai hadiah seperti berbagai macam voucher (Ditukarkan pada merchant).<br><br>
            </p>
        </div>
        @elseif($this->session->user_login['role']=="Relawan")
        <div>
            <p>
                <h3>Relawan</h3>
                Apa saja yang dapat anda lakukan dan anda dapatkan di aplikasi SIMARAK ini sebagai Relawan dalam berbagi kebermanfaatan?<br><br>
                <h5>Tugas Relawan</h5>
                Relawan bertugas mengambil makanan ke tempat yang telah ditentukan oleh donatur dan mengantarkan makanan tersebut ke penerima makanan yang alamatnya telah dicantumkan pada aplikasi.<br><br>
                <h5>Notifikasi</h5>
                Penerima akan mendapatkan notifikasi apabila sistem memilih akun relawan tersebut sebagai pengantar makanan.<br><br>
                <h5>Pemasukan</h5>
                Relawan mendapatkan pemasukan keuangan setelah proses pengantaran makanan berhasil dilakukan <br><br>     
                <h5>Poin dan Hadiah</h5>
                Relawan akan mendapatkan tambahan poin jika berpartisipasi dalam aplikasi ini, dan dapat ditukar dengan berbagai hadiah seperti berbagai macam voucher (Ditukarkan pada merchant).<br><br>
            </p>
        </div>
        @endif
        <!-- <h2 class="content-heading text-default">ALUR PENGISIAN KONDISI KERUSAKAN SEKOLAH</h2>
        <div class="row gutters-tiny">
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-danger ribbon-left bg-gray-light">
                        <div class="ribbon-box">1</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-user fa-3x text-danger"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-danger">1. Profil Petugas</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-danger ribbon-left bg-gray-light">
                        <div class="ribbon-box">2</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-list fa-3x text-danger"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-danger">2. Pelaksanaan Survey</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-info ribbon-left bg-gray-light">
                        <div class="ribbon-box">3</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-image fa-3x text-info"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-info">3. Upload LayoutPlan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-info ribbon-left bg-gray-light">
                        <div class="ribbon-box">4</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-plus fa-3x text-info"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-info">4. Tambah Ruangan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters-tiny">
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-primary ribbon-left bg-gray-light">
                        <div class="ribbon-box">5</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-upload fa-3x text-primary"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-primary">5. Upload Kondisi</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-primary ribbon-left bg-gray-light">
                        <div class="ribbon-box">6</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-upload fa-3x text-primary"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-primary">6. Kesimpulan Kondisi</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-success ribbon-left bg-gray-light">
                        <div class="ribbon-box">7</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-upload fa-3x text-success"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-success">7. Download Laporan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-success ribbon-left bg-gray-light">
                        <div class="ribbon-box">8</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-check fa-3x text-success"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-success">8. Selesai</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <h2 class="content-heading text-default">KETERANGAN</h2>
        <div class="row">
            <div class="col-lg-6 col-6">
                <div class="text-blue">
                    <h5>Profil Petugas</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Melihat & mengedit profil petugas pada <b class="text-danger">Menu Profil Petugas</b></p>
                    <h5>Pelaksanaan Survey</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Mengisi pelaksanaan survey <b class="text-danger">Menu Pelaksanaan Survey</b></p>
                    <h5>Upload Layout Plan</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Mengupload denah sekolah atau layout plan <b class="text-danger">Menu Layout Plan</b></p>
                    <h5>Menambah Ruangan Tiap Sekolah</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Tambah ruangan tiap sekolah pada <b class="text-danger">Menu Ruang Sekolah</b></p>
                    <p><i class="fa fa-arrow-right mr-5"></i> Menambah, melihat, mengubah dan menghapus ruangan pada <b class="text-danger">Menu Ruang Sekolah</b></p>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <div class="text-blue">
                    <h5>Upload Kondisi Komponen Ruang</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Upload kondisi komponen tiap ruang pada <b class="text-danger">Menu Kondisi Sekolah</b></p>
                    <h5>Isi Kesimpulan Kondisi Ruang</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Mengisi kesimpulan ada pada <b class="text-danger">Menu Kondisi Sekolah</b></p>
                    <h5>Download Laporan</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Downlaod laporan (cover, laporan kondisi kerusakan) pada <b class="text-danger">Menu Download Laporan</b></p>
                </div>
            </div>
        </div> -->
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

    var locations = []
    var labels = []
    i = 1;
    <?php foreach ($sebaran as $data) { ?>
        locations.push({
            lat: parseFloat("<?php echo $data->latitude; ?>"),
            lng: parseFloat("<?php echo $data->longitude; ?>"),
        });
        labels.push(i.toString());
        i++;
    <?php } ?>
</script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: -7.4469817, lng: 112.6959943}
        });
        var markers = locations.map(function(location, i) {
            return new google.maps.Marker({
                position: location,
                label: labels[i]
            });
        });
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }
</script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTnAg_gwZ-GQxB6xC0h2cY4TDFYU28ov8&callback=initMap"></script>
@endsection
