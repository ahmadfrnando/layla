<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        {{ Breadcrumbs::render() }}
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center ms-2">
                        <a href="{{ route('pimpinan.profile.index') }}">
                            <button class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Profil</span>
                                <span class="d-sm-inline d-none">({{ Auth::user()->role->role }})</span>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center ms-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-sign-out-alt me-sm-1"></i>
                                <span class="d-sm-inline d-none">Keluar</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>