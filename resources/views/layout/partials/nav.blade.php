<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <div style="float: left; padding: 10px; font-size: 25px; font-weight: bold; ">
            PT. Eka Kemasindo Asri
        </div>

        <nav class="nav navbar-nav">
            <ul class="navbar-right">

                <!-- Profil Pengguna -->
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <h6 class="mb-0 text-gray-600">Welcome, {{ Auth::guard('user')->user()->name }}</h6>
                    </a>
                    {{-- <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                       
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log
                                Out</button>
                        </form>
                    </div> --}}
                </li>
            </ul>
        </nav>
    </div>
</div>
