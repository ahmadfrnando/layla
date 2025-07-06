@extends('layouts.afdeling')

@section('content')
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Muatan</p>
              <h5 class="font-weight-bolder">
                {{ $jumlahMuatan->sum('muatan_pabrik') }} Kg
              </h5>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder">{{ date('M') }}</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Tandan</p>
              <h5 class="font-weight-bolder">
                {{ $jumlahMuatan->sum('tandan_pabrik') }} Buah
              </h5>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder">{{ date('M') }}</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Supir</p>
              <h5 class="font-weight-bolder">
                {{ $supir->count() }}
              </h5>
              <p class="mb-0">
                <span class="text-danger text-sm font-weight-bolder">Orang</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Muatan Belum Diinput</p>
              <h5 class="font-weight-bolder">
                {{ $jumlahMuatan->where('not', 'muatan_pabrik', null)->where('tanggal', date('Y-m-d'))->count() }}
              </h5>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder">{{ date('M') }}</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
              <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection