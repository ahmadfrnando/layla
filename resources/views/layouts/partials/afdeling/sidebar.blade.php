<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank"> <span class="ms-1 font-weight-bold" style="">Perkebunan Sawit AM4</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('afdeling.dashboard') ? 'active' : '' }}" href="{{ route('afdeling.dashboard') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-chart-pie text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('afdeling.tambah-muatan.*') ? 'active' : '' }}" href="{{ route('afdeling.tambah-muatan.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Buat Muatan Baru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('afdeling.hasil-panen.*') ? 'active' : '' }}" href="{{ route('afdeling.hasil-panen.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-spa text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Hasil Panen</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('afdeling.supir.*') ? 'active' : '' }}" href="{{ route('afdeling.supir.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-tie text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Supir</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('afdeling.jadwal-operasional.*') ? 'active' : '' }}" href="{{ route('afdeling.jadwal-operasional.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users-cog text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Operasional</span>
                </a>
            </li>
        </ul>
    </div>
</aside>