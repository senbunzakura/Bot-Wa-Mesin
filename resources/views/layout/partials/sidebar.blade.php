<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0; margin-top:10px;">
            <a href="/dashboard" class="site_title"><img src="{{ asset('assets/images/INKP.JK.png') }}" style="width: 55px"
                    height="auto"><span class="pl-2">MesinCare </span></a>
        </div>

        <div class="clearfix"></div>



        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    <li><a href="/"><i class="fa fa-home"></i> Dashboard</a>
                    </li>

                    </li>


                    {{-- @if (Auth::guard('user')->user()->role == 'Admin') --}}
                    <li><a><i class="fa fa-tachometer"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            {{-- @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan') --}}
                            <li><a href="/akun">Data Akun</a></li>
                            <li><a href="/mesin">Data Mesin</a></li>

                        </ul>
                    </li>
                    {{-- @endif --}}


                    <li><a><i class="fa fa-desktop"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            <li><a href="/laporan-kerusakan">Laporan Kerusakan</a></li>
                            <li><a href="/perbaikan">Jadwal Perbaikan</a></li>
                            <li><a href="/perawatan">Jadwal Perawatan</a></li>

                        </ul>
                    </li>

                    <li><a><i class="fa fa-file"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/laporan-perawatan">Laporan Perawatan</a></li>
                            <li><a href="/laporan-perbaikan">Laporan Perbaikan</a></li>

                        </ul>

                    </li>
                    <li>
                        {{-- @endif --}}

                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->


        <!-- /menu footer buttons -->
    </div>
</div>
