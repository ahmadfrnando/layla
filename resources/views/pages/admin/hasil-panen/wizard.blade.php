<div class="card-header pb-0 d-flex justify-content-between">
    <div>
        <h6>Data Hasil Panen</h6>
        <p class="text-sm">Berikut adalah data hasil panen yang telah tercatat.</p>
    </div>
    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1">
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 {{ request()->routeIs('admin.hasil-panen.index') ? 'active' : '' }} d-flex align-items-center justify-content-center" href="{{ route('admin.hasil-panen.index') }}" >
                        <i class="fas fa-list"></i>
                        <span class="ms-2">Semua Pengangkutan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 {{ request()->routeIs('admin.hasil-panen.create') ? 'active' : '' }} d-flex align-items-center justify-content-center " href="{{ route('admin.hasil-panen.create') }}" aria-selected="true">
                        <i class="fas fa-check"></i>
                        <span class="ms-2">Input Pengangkutan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>