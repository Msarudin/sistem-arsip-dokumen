<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('login', 'Auth::index');
$routes->post('login/proses', 'Auth::proses');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->get('kategori', 'Kategori::index', ['filter' => 'auth']);
$routes->post('kategori/simpan', 'Kategori::simpan', ['filter' => 'auth']);
$routes->post('kategori/update/(:num)', 'Kategori::update/$1', ['filter' => 'auth']);
$routes->get('kategori/hapus/(:num)', 'Kategori::hapus/$1', ['filter' => 'auth']);

$routes->get('arsip', 'Arsip::index', ['filter' => 'auth']);
$routes->post('arsip/simpan', 'Arsip::simpan', ['filter' => 'auth']);
$routes->post('arsip/update/(:num)', 'Arsip::update/$1', ['filter' => 'auth']);
$routes->get('arsip/hapus/(:num)', 'Arsip::hapus/$1', ['filter' => 'auth']);
$routes->get('arsip/lihat/(:num)', 'Arsip::lihat/$1', ['filter' => 'auth']);
$routes->get('arsip/download/(:num)', 'Arsip::download/$1', ['filter' => 'auth']);
