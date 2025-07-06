<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// admin
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('admin.dashboard'));
});

Breadcrumbs::for('admin.manajemen-karyawan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Karyawan', route('admin.manajemen-karyawan.index'));
});
Breadcrumbs::for('admin.manajemen-karyawan.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.manajemen-karyawan.index');
    $trail->push('Ubah Karyawan', route('admin.manajemen-karyawan.edit', 'id'));
});
Breadcrumbs::for('admin.manajemen-karyawan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.manajemen-karyawan.index');
    $trail->push('Tambah Karyawan', route('admin.manajemen-karyawan.create'));
});
Breadcrumbs::for('admin.hasil-panen.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Hasil Panen', route('admin.hasil-panen.index'));
});
Breadcrumbs::for('admin.hasil-panen.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.hasil-panen.index');
    $trail->push('Tambah', route('admin.hasil-panen.create'));
});
Breadcrumbs::for('admin.hasil-panen.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.hasil-panen.index');
    $trail->push('Ubah', route('admin.hasil-panen.edit', 'id'));
});

Breadcrumbs::for('admin.pemupukan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Hasil Panen', route('admin.pemupukan.index'));
});
Breadcrumbs::for('admin.pemupukan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pemupukan.index');
    $trail->push('Tambah', route('admin.pemupukan.create'));
});
Breadcrumbs::for('admin.pemupukan.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pemupukan.index');
    $trail->push('Ubah', route('admin.pemupukan.edit', 'id'));
});

Breadcrumbs::for('admin.pemeliharaan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Pemeliharaan', route('admin.pemeliharaan.index'));
});
Breadcrumbs::for('admin.pemeliharaan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pemeliharaan.index');
    $trail->push('Tambah', route('admin.pemeliharaan.create'));
});
Breadcrumbs::for('admin.pemeliharaan.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pemeliharaan.index');
    $trail->push('Ubah', route('admin.pemeliharaan.edit', 'id'));
});

Breadcrumbs::for('admin.jadwal-tugas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Jadwal Tugas', route('admin.jadwal-tugas.index'));
});
Breadcrumbs::for('admin.jadwal-tugas.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.jadwal-tugas.index');
    $trail->push('Tambah', route('admin.jadwal-tugas.create'));
});
Breadcrumbs::for('admin.jadwal-tugas.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.jadwal-tugas.index');
    $trail->push('Ubah', route('admin.jadwal-tugas.edit', 'id'));
});

Breadcrumbs::for('admin.laporan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Semua Laporan', route('admin.laporan.index'));
});
Breadcrumbs::for('admin.pengaturan-pengguna.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Semua Pengguna', route('admin.pengaturan-pengguna.index'));
});

Breadcrumbs::for('admin.pengaturan-pengguna.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pengaturan-pengguna.index');
    $trail->push('Tambah Pengguna', route('admin.pengaturan-pengguna.create'));
});

// afdeling
Breadcrumbs::for('admin.afdeling.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Afdeling', route('admin.afdeling.index'));
});
Breadcrumbs::for('admin.afdeling.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.afdeling.index');
    $trail->push('Tambah Afdeling', route('admin.afdeling.create'));
});
Breadcrumbs::for('admin.afdeling.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.afdeling.index');
    $trail->push('Ubah', route('admin.afdeling.edit', 'id'));
});

// supir
Breadcrumbs::for('admin.supir.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('supir', route('admin.supir.index'));
});
Breadcrumbs::for('admin.supir.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.supir.index');
    $trail->push('Tambah Data Supir', route('admin.supir.create'));
});
Breadcrumbs::for('admin.supir.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.supir.index');
    $trail->push('Ubah', route('admin.supir.edit', 'id'));
});

// profile
Breadcrumbs::for('admin.profile.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile', route('admin.profile.index'));
});

// pengguna
Breadcrumbs::for('admin.pengguna.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Pengguna', route('admin.pengguna.index'));
});
Breadcrumbs::for('admin.pengguna.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pengguna.index');
    $trail->push('Ubah Kata Sandi', route('admin.pengguna.edit', 'id'));
});

// afdeling-dashboard
Breadcrumbs::for('afdeling.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('afdeling.dashboard'));
});

// afdeling-profile
Breadcrumbs::for('afdeling.profile.index', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.dashboard');
    $trail->push('Profile', route('afdeling.profile.index'));
});

// afdeling-hasil panen
Breadcrumbs::for('afdeling.hasil-panen.index', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.dashboard');
    $trail->push('Pemanenan', route('afdeling.hasil-panen.index'));
});

// afdeling-tambah muatan
Breadcrumbs::for('afdeling.tambah-muatan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.dashboard');
    $trail->push('Data Muatan', route('afdeling.tambah-muatan.index'));
});

Breadcrumbs::for('afdeling.tambah-muatan.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.tambah-muatan.index');
    $trail->push('Ubah Muatan', route('afdeling.tambah-muatan.edit', 'id'));
});
Breadcrumbs::for('afdeling.tambah-muatan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.tambah-muatan.index');
    $trail->push('Tambah Muatan Baru', route('afdeling.tambah-muatan.create'));
});

// afdeling-supir
Breadcrumbs::for('afdeling.supir.index', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.dashboard');
    $trail->push('Data Supir', route('afdeling.supir.index'));
});

// afdeling-jadwal-operasional
Breadcrumbs::for('afdeling.jadwal-operasional.index', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.dashboard');
    $trail->push('Data Jadwal Operasional', route('afdeling.jadwal-operasional.index'));
});

Breadcrumbs::for('afdeling.jadwal-operasional.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.jadwal-operasional.index');
    $trail->push('Ubah Jadwal', route('afdeling.jadwal-operasional.edit', 'id'));
});
Breadcrumbs::for('afdeling.jadwal-operasional.create', function (BreadcrumbTrail $trail) {
    $trail->parent('afdeling.jadwal-operasional.index');
    $trail->push('Tambah Jadwal Baru', route('afdeling.jadwal-operasional.create'));
});

// pimpinan - dashboard
Breadcrumbs::for('pimpinan.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('pimpinan.dashboard'));
});

Breadcrumbs::for('pimpinan.data-operasional.index', function (BreadcrumbTrail $trail) {
    $trail->parent('pimpinan.dashboard');
    $trail->push('Data Operasional', route('pimpinan.data-operasional.index'));
});
Breadcrumbs::for('pimpinan.data-operasional.form-cetak', function (BreadcrumbTrail $trail) {
    $trail->parent('pimpinan.data-operasional.index');
    $trail->push('Cetak', route('pimpinan.data-operasional.form-cetak'));
});