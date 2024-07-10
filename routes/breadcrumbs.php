<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Beranda', route('home'));
});

Breadcrumbs::for('categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Kategori', route('categories.index'));
});

Breadcrumbs::for('categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('categories.index');
    $trail->push('Create', route('categories.create'));
});

Breadcrumbs::for('categories.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories.index');
    $trail->push('Edit', route('categories.edit', $category));
});

Breadcrumbs::for('transactions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Transaksi', route('transactions.index'));
});

Breadcrumbs::for('transactions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('transactions.index');
    $trail->push('Create', route('transactions.create'));
});

Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Produk', route('products.index'));
});

Breadcrumbs::for('products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('products.index');
    $trail->push('Create', route('products.create'));
});

Breadcrumbs::for('products.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('products.index');
    $trail->push('Edit', route('products.edit', $product));
});

Breadcrumbs::for('reports.monthly', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Laporan Bulanan', route('reports.monthly'));
});

Breadcrumbs::for('reports.products', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Laporan Produk', route('reports.product'));
});

Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Create', route('roles.create'));
});

Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles.index');
    $trail->push('Edit', route('roles.edit', $role));
});

Breadcrumbs::for('permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Permissions', route('permissions.index'));
});

Breadcrumbs::for('permissions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('permissions.index');
    $trail->push('Create', route('permissions.create'));
});

Breadcrumbs::for('permissions.edit', function (BreadcrumbTrail $trail, $permission) {
    $trail->parent('permissions.index');
    $trail->push('Edit', route('permissions.edit', $permission));
});

Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.index');
    $trail->push('Edit', route('users.edit', $user));
});


