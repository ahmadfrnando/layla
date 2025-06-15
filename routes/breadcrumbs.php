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
Breadcrumbs::for('admin.hasil-panen.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.hasil-panen.index');
    $trail->push('Tambah', route('admin.hasil-panen.create'));
});
Breadcrumbs::for('admin.pemupukan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Pemupukan', route('admin.pemupukan.index'));
});