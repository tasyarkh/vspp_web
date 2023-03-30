<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);//auto route ke dalam method controller
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Auth
$routes->get('/', 'Auth::login'); //menampilkan halaman
$routes->post('/check', 'Auth::checkLogin'); //cek db
$routes->get('/logout', 'Auth::logout'); //logout
$routes->get('/register', 'Auth::register'); //menampilkan halaman
$routes->post('/register/create', 'Auth::createUser');
$routes->get('/loginSiswa', 'Auth::loginSiswa');
$routes->post('/checkSiswa', 'Auth::checkSiswa');


//Section Admin => Dashboard
$routes->get('/dashAdmin', 'Admin::index');

//Section Admin => SPP
$routes->get('/spp', 'Admin::spp');
$routes->post('/spp/tambah', 'Admin::tambahSpp');
$routes->post('/spp/edit', 'Admin::editSpp');

//Section Admin => Kelas
$routes->get('/kelas', 'Admin::kelas');
$routes->post('/kelas/tambah', 'Admin::tambahKel');
$routes->post('/kelas/edit', 'Admin::editKel');

//Section Admin => Siswa
$routes->get('/siswaAdmin', 'Admin::siswa');
$routes->post('/siswa/tambah', 'Admin::tambahSis');
$routes->post('/siswa/edit', 'Admin::editSis');

//Section Admin => Petugas
$routes->get('/petugasAdmin', 'Admin::petugas');
$routes->post('/petugas/tambah', 'Admin::tambahPet');
$routes->post('/petugas/edit', 'Admin::editPet');

//Section Admin => Transaksi
$routes->get('/transaksiAdmin', 'Admin::transaksi'); //bisa edit tambah
$routes->post('/transaksi/tambah', 'Admin::tambahTrans');
$routes->post('/transaksi/edit', 'Admin::editTrans'); 

//Section Admin = Riwayat
$routes->get('/riwayatAdmin', 'Admin::riwayat'); 
$routes->get('/riwayat/cetakAdmin', 'Admin::cetakAdmin'); 


//Section Petugas => Dashboard
$routes->get('/dashPetugas', 'Petugas::index'); 

//Section Petugas => Transaksi
$routes->get('/transaksiPetugas', 'Petugas::transaksi'); 
$routes->post('/transaksiPetugas/tambah', 'Petugas::tambahTrans');

//Section Petugas => History
$routes->get('/riwayatPetugas', 'Petugas::history'); 
$routes->post('/transaksiPetugas/edit', 'Petugas::editTrans');
$routes->get('/riwayat/cetakPetugas', 'Petugas::cetakPetugas'); 


//Section Siswa => Dashboard
$routes->get('/dashSiswa', 'Siswa::index'); 

//Section Siswa => History
$routes->get('/historySiswa', 'Siswa::history/$nisn'); 
$routes->get('/riwayat/cetakSiswa', 'Siswa::cetakSiswa');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
