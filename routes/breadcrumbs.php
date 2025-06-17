<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('admin.dashboard'));
});

// Home > Blog
Breadcrumbs::for('admin.hasil-panen.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Pemanenan', route('admin.hasil-panen.index'));
});
Breadcrumbs::for('admin.hasil-panen.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.hasil-panen.index');
    $trail->push('Tambah', route('admin.hasil-panen.show', 'id'));
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