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

// PETUGAS
Breadcrumbs::for('petugas.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('petugas.dashboard'));
});

Breadcrumbs::for('petugas.hasil-panen.index', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.dashboard');
    $trail->push('Hasil Panen', route('petugas.hasil-panen.index'));
});
Breadcrumbs::for('petugas.hasil-panen.create', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.hasil-panen.index');
    $trail->push('Tambah', route('petugas.hasil-panen.create'));
});
Breadcrumbs::for('petugas.hasil-panen.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.hasil-panen.index');
    $trail->push('Ubah', route('petugas.hasil-panen.edit', 'id'));
});

Breadcrumbs::for('petugas.pemupukan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.dashboard');
    $trail->push('Hasil Panen', route('petugas.pemupukan.index'));
});
Breadcrumbs::for('petugas.pemupukan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.pemupukan.index');
    $trail->push('Tambah', route('petugas.pemupukan.create'));
});
Breadcrumbs::for('petugas.pemupukan.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.pemupukan.index');
    $trail->push('Ubah', route('petugas.pemupukan.edit', 'id'));
});

Breadcrumbs::for('petugas.pemeliharaan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.dashboard');
    $trail->push('Pemeliharaan', route('petugas.pemeliharaan.index'));
});
Breadcrumbs::for('petugas.pemeliharaan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.pemeliharaan.index');
    $trail->push('Tambah', route('petugas.pemeliharaan.create'));
});
Breadcrumbs::for('petugas.pemeliharaan.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.pemeliharaan.index');
    $trail->push('Ubah', route('petugas.pemeliharaan.edit', 'id'));
});

Breadcrumbs::for('petugas.jadwal-tugas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.dashboard');
    $trail->push('Jadwal Tugas', route('petugas.jadwal-tugas.index'));
});
Breadcrumbs::for('petugas.jadwal-tugas.create', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.jadwal-tugas.index');
    $trail->push('Tambah', route('petugas.jadwal-tugas.create'));
});
Breadcrumbs::for('petugas.jadwal-tugas.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.jadwal-tugas.index');
    $trail->push('Ubah', route('petugas.jadwal-tugas.edit', 'id'));
});

Breadcrumbs::for('petugas.laporan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.dashboard');
    $trail->push('Semua Laporan', route('petugas.laporan.index'));
});
Breadcrumbs::for('petugas.pengaturan-pengguna.index', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.dashboard');
    $trail->push('Semua Pengguna', route('petugas.pengaturan-pengguna.index'));
});

Breadcrumbs::for('petugas.pengaturan-pengguna.create', function (BreadcrumbTrail $trail) {
    $trail->parent('petugas.pengaturan-pengguna.index');
    $trail->push('Tambah Pengguna', route('petugas.pengaturan-pengguna.create'));
});

//pimpinan
Breadcrumbs::for('manajer.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('manajer.dashboard'));
});

Breadcrumbs::for('manajer.hasil-panen.index', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.dashboard');
    $trail->push('Hasil Panen', route('manajer.hasil-panen.index'));
});
Breadcrumbs::for('manajer.hasil-panen.create', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.hasil-panen.index');
    $trail->push('Tambah', route('manajer.hasil-panen.create'));
});
Breadcrumbs::for('manajer.hasil-panen.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.hasil-panen.index');
    $trail->push('Ubah', route('manajer.hasil-panen.edit', 'id'));
});

Breadcrumbs::for('manajer.pemupukan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.dashboard');
    $trail->push('Hasil Panen', route('manajer.pemupukan.index'));
});
Breadcrumbs::for('manajer.pemupukan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.pemupukan.index');
    $trail->push('Tambah', route('manajer.pemupukan.create'));
});
Breadcrumbs::for('manajer.pemupukan.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.pemupukan.index');
    $trail->push('Ubah', route('manajer.pemupukan.edit', 'id'));
});

Breadcrumbs::for('manajer.pemeliharaan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.dashboard');
    $trail->push('Pemeliharaan', route('manajer.pemeliharaan.index'));
});
Breadcrumbs::for('manajer.pemeliharaan.create', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.pemeliharaan.index');
    $trail->push('Tambah', route('manajer.pemeliharaan.create'));
});
Breadcrumbs::for('manajer.pemeliharaan.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.pemeliharaan.index');
    $trail->push('Ubah', route('manajer.pemeliharaan.edit', 'id'));
});

Breadcrumbs::for('manajer.jadwal-tugas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.dashboard');
    $trail->push('Jadwal Tugas', route('manajer.jadwal-tugas.index'));
});
Breadcrumbs::for('manajer.jadwal-tugas.create', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.jadwal-tugas.index');
    $trail->push('Tambah', route('manajer.jadwal-tugas.create'));
});
Breadcrumbs::for('manajer.jadwal-tugas.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.jadwal-tugas.index');
    $trail->push('Ubah', route('manajer.jadwal-tugas.edit', 'id'));
});

Breadcrumbs::for('manajer.laporan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.dashboard');
    $trail->push('Semua Laporan', route('manajer.laporan.index'));
});
Breadcrumbs::for('manajer.pengaturan-pengguna.index', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.dashboard');
    $trail->push('Semua Pengguna', route('manajer.pengaturan-pengguna.index'));
});

Breadcrumbs::for('manajer.pengaturan-pengguna.create', function (BreadcrumbTrail $trail) {
    $trail->parent('manajer.pengaturan-pengguna.index');
    $trail->push('Tambah Pengguna', route('manajer.pengaturan-pengguna.create'));
});