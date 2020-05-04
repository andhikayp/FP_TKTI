<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">R</span><span class="text-primary">D</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout"
                    data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="#">
                        
                        <span class="font-size-xl text-dual-primary-dark">SIMARAK </span> 
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="" style="width: 100px;" src="{{ base_url('/img/logo123.png') }}"
                    alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="#">
                    <img class="img-avatar" style="width: 70px;" src="{{ base_url('/img/logo123.png') }}" alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle"
                            href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="{{ base_url('Sessions/logout') }}">
                            <i class="si si-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a href="{{ base_url('/dashboard/index') }}" class="
                        @if($this->router->fetch_class() == 'dashboard' && $this->router->fetch_method() == 'index')
                            active
                        @endif">
                        <i class="fa fa-home"></i><span class="sidebar-mini-hide">Dashboard</span>
                    </a>
                </li>

                @if($this->session->user_login['role'] == "Donatur")
                <!-- <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Receptionist</span></li> -->
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Donatur</span></li>
                <li>
                    <a href="{{ base_url('DonaturController/create') }}" class="
                        @if($this->router->fetch_class() == 'DonaturController')
                            active
                        @endif">
                        <i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Tambah Donasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('DonaturController/index') }}" class="
                        @if($this->router->fetch_class() == 'DonaturController')
                            active
                        @endif">
                        <i class="fa fa-file-text"></i><span class="sidebar-mini-hide">Riwayat Donasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('MenuController/daftarMitra') }}" class="
                        @if($this->router->fetch_class() == 'MenuController')
                            active
                        @endif">
                        <i class="fa fa-file-text"></i><span class="sidebar-mini-hide">Daftar Mitra</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{ base_url('TransaksiController/index') }}" class="
                        @if($this->router->fetch_class() == 'TransaksiController')
                            active
                        @endif">
                        <i class="fa fa-pencil-square-o"></i><span class="sidebar-mini-hide">Cek Kandungan gula dalam makanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('LaporanController/index') }}" class="
                        @if($this->router->fetch_class() == 'LaporanController')
                            active
                        @endif">
                        <i class="fa fa-folder"></i><span class="sidebar-mini-hide">Riwayat Pengecekan Makanan</span>
                    </a>
                </li> -->

                @elseif($this->session->user_login['role'] == "Penerima")
                @if($this->session->user_login['is_verif'] == "1")
                    <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Penerima Makanan</span></li>
                    <li>
                        <a href="{{ base_url('DonaturController/request') }}" class="
                            @if($this->router->fetch_class() == 'DonaturController')
                                active
                            @endif">
                            <i class="fa fa-credit-card "></i><span class="sidebar-mini-hide">Tambah Permintaan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ base_url('DonaturController/list_request') }}" class="
                            @if($this->router->fetch_class() == 'DonaturController')
                                active
                            @endif">
                            <i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Riwayat Permintaan</span>
                        </a>
                    </li>
                @endif

                @elseif($this->session->user_login['role'] == "Admin")
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Admin</span></li>
                <li>
                    <a href="{{ base_url('PetugasController/list_user') }}" class="
                        @if($this->router->fetch_class() == 'PetugasController')
                            active
                        @endif">
                        <i class="fa fa-credit-card "></i><span class="sidebar-mini-hide">Manajemen User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('DonaturController/index') }}" class="
                        @if($this->router->fetch_class() == 'DonaturController')
                            active
                        @endif">
                        <i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Manajemen Donasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('DonaturController/list_request') }}" class="
                        @if($this->router->fetch_class() == 'DonaturController')
                            active
                        @endif">
                        <i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Manajemen Permintaan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('BarangController/index') }}" class="
                        @if($this->router->fetch_class() == 'BarangController')
                            active
                        @endif">
                        <i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Pesan Makanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('BarangController/index') }}" class="
                        @if($this->router->fetch_class() == 'BarangController')
                            active
                        @endif">
                        <i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Bayar Relawan</span>
                    </a>
                </li>

                @elseif($this->session->user_login['role'] == "Relawan")
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Relawan</span></li>
                <li>
                    <a href="{{ base_url('TransaksiController/index') }}" class="
                        @if($this->router->fetch_class() == 'TransaksiController')
                            active
                        @endif">
                        <i class="fa fa-credit-card "></i><span class="sidebar-mini-hide">Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('BarangController/index') }}" class="
                        @if($this->router->fetch_class() == 'BarangController')
                            active
                        @endif">
                        <i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Manajemen Barang</span>
                    </a>
                </li>

                @elseif($this->session->user_login['role'] == "Mitra")
                    <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Mitra Pembuat Makanan</span></li>
                    <li>
                        <a href="{{ base_url('MitraController/pesanan_masuk') }}" class="
                            @if($this->router->fetch_class() == 'MitraController')
                                active
                            @endif">
                            <i class="fa fa-credit-card "></i><span class="sidebar-mini-hide">Pesanan Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ base_url('BarangController/index') }}" class="
                            @if($this->router->fetch_class() == 'BarangController')
                                active
                            @endif">
                            <i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Pesanan Siap Antar</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->