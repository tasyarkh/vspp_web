<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetugasModel;
use App\Models\KelasModel;
use App\Models\SppModel;
use App\Models\SiswaModel;
use App\Models\TransaksiModel;

class Admin extends BaseController
{
    protected $kelasModel;
    protected $sppModel;
    protected $siswaModel;
    protected $petugasModel;
    protected $transModel;

    //method untuk meninisialisali model dan menampung properti
    public function __construct()
    {
        $this->kelasModel = new KelasModel();
        $this->sppModel = new SppModel();
        $this->siswaModel = new SiswaModel();
        $this->petugasModel = new PetugasModel();
        $this->transModel = new TransaksiModel();
    }

    //section dashboard
    public function index()
    {
        if (session('level') != 'ADMIN') {
            session()->setFlashdata('gagal', 'Anda Belum Login');
            return redirect()->to(base_url('/'));
        }

        $siswa = $this->siswaModel->countSiswa();
        $spp = $this->sppModel->countSpp();
        $kelas = $this->kelasModel->countKelas();
        $petugas = $this->petugasModel->countPetugas();
        $data = [
            'title' => 'Dashboard Admin | V-SPP',
            'siswa' => $siswa,
            'spp' => $spp,
            'kelas' => $kelas,
            'petugas' => $petugas,
            'connect' => \Config\Database::connect()
        ];

        //menampilkan view dashboard admin
        return view('pages/admin/index', $data);
    }

    //section spp
    public function spp()
    {
        $spp = $this->sppModel->findAll();
        $data = [
            'title' => 'Data SPP | V-SPP',
            'spp' => $spp
        ];

        //menampilkan view spp
        return view('pages/admin/spp/index', $data);
    }

    //function untuk tambah spp
    public function tambahSpp(){
        $data = array(
            'id' => $this->request->getVar('id'),
            'tahun' => $this->request->getVar('tahun'),
            'bulan' => $this->request->getVar('bulan'),
            'nominal' => $this->request->getVar('nominal'),
        );

        $this->sppModel->saveSpp($data);
        session()->setFlashdata('tmb', 'SPP Berhasil Ditambah');
        return redirect()->to(base_url('spp'));
    }

    //menampilkan update spp
    public function editSpp()
    {
         $id = $this->request->getPost('id');
         $data = array(
             'tahun'        => $this->request->getPost('tahun'),
             'bulan'        => $this->request->getPost('bulan'),
             'nominal'        => $this->request->getPost('nominal'),
         );
         $this->sppModel->updateSpp($data, $id);
         session()->setFlashdata('edt', 'SPP berhasil diubah');
         return redirect()->to(base_url('spp'));
    }

    //eksekusi query update spp
    public function updateSpp($id)
     {
         helper(['form', 'url']);
         $validation = $this->validate([
             'nominal' => [
                 'rules'  => 'required',
                 'errors' => [
                     'required' => 'Masukkan nominal'
                 ]
             ],
         ]);
 
         if (!$validation) {
 
             //model initialize
             $sppModel = new SppModel();
 
             //render view with error validation message
             return view('spp', [
                 'edit' => $sppModel->find($id),
                 'validation' => $this->validator
             ]);
         } else {
 
             //model initialize
             $sppModel = new SppModel();
 
             //insert data into database
             $sppModel->update($id, [
                 'id'   => $this->request->getPost('id'),
                 'tahun' => $this->request->getPost('tahun'),
                 'bulan' => $this->request->getPost('bulan'),
                 'nominal' => $this->request->getPost('nominal'),
             ]);
 
             //flash message
             session()->setFlashdata('edt', 'SPP Berhasil Diupdate');
 
             return redirect()->to(base_url('spp'));
         }
     }

     //query delete data spp
     public function hapusSpp($id)
     {
         $this->sppModel->delete($id);
         session()->setFlashdata('hps', 'SPP telah dihapus');
         return redirect()->to(base_url('spp'));
     }

     //section kelas
     public function kelas()
     {
         $kelas = $this->kelasModel->findAll();
         $data = [
             'title' => 'Data Kelas | V-SPP',
             'kelas' => $kelas
         ];
 
         return view('pages/admin/kelas/index', $data);
     }

     //function tambah kelas
     public function tambahKel(){
        $data = array(
            'id' => $this->request->getVar('id'),
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'jurusan' => $this->request->getVar('jurusan'),
        );

        $this->kelasModel->saveKelas($data);
        session()->setFlashdata('tmb', 'Kelas Berhasil Ditambah');
        return redirect()->to(base_url('kelas'));
    }

    //tampilan edit kelas
    public function editKel()
     {
         $id = $this->request->getPost('id');
         $data = array(
             'nama_kelas'        => $this->request->getPost('nama_kelas'),
             'jurusan'        => $this->request->getPost('jurusan'),
         );
         $this->kelasModel->updateKelas($data, $id);
         session()->setFlashdata('edt', 'Kelas berhasil diubah');
         return redirect()->to(base_url('kelas'));
     }

     //mengeksekusi query update kelas  
     public function updateKelas($id)
     {
         helper(['form', 'url']);
 
         $validation = $this->validate([
             'nama_kelas' => [
                 'rules'  => 'required',
                 'errors' => [
                     'required' => 'Masukkan Nama Kelas'
                 ]
             ],
         ]);
 
         if (!$validation) {
 
             //model initialize
             $kelasModel = new KelasModel();
 
             //render view with error validation message
             return view('kelas', [
                 'edit' => $kelasModel->find($id),
                 'validation' => $this->validator
             ]);
         } else {
 
             //model initialize
             $kelasModel = new KelasModel();
 
             //insert data into database
             $kelasModel->update($id, [
                 'id'   => $this->request->getPost('id'),
                 'nama_kelas' => $this->request->getPost('nama_kelas'),
                 'jurusan' => $this->request->getPost('jurusan'),
             ]);
 
             //flash message
             session()->setFlashdata('edt', 'Kelas Berhasil Diupdate');
 
             return redirect()->to(base_url('kelas'));
         }
     }

     //function hapus data kelas
     public function hapusKel($id)
     {
         $this->kelasModel->delete($id);
         session()->setFlashdata('hps', 'Kelas telah dihapus');
         return redirect()->to(base_url('kelas'));
     }

    //section siswa
    public function siswa()
    {
        $spp = $this->sppModel->findAll();
        $kelas = $this->kelasModel->findAll();
        $siswa = $this->siswaModel->getData();
        $data = [
            'title' => 'Data Siswa | V-SPP',
            'siswa' => $siswa,
            'spp' => $spp,
            'kelas' => $kelas

        ];

        return view('pages/admin/siswa/index', $data);
    }

    //function tambah siswa
    public function tambahSis(){
        
        $data = array(
            'nisn' => $this->request->getVar('nisn'),
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'kelas_id'=> $this->request->getVar('kelas_id'),
            'alamat'=> $this->request->getVar('alamat'),
            'telp'=> $this->request->getVar('telp'),
            'level'=> $this->request->getVar('level'),
        );

        $this->siswaModel->saveSiswa($data);
        session()->setFlashdata('tmb', 'Siswa Berhasil Ditambah');
        return redirect()->to(base_url('siswaAdmin'));
    }

    public function getSpp()
    {
        $data['spp'] = $this->sppModel->getSpp(); //ganti Model dengan nama model yang digunakan
        return view('siswaAdmin', $data); //ganti view_form dengan nama view yang akan menampilkan form pilihan
    }

    //tampilan update siswa
    public function editSis()
     {
         $nisn = $this->request->getPost('nisn');
         $data = array(
             'nis'        => $this->request->getPost('nis'),
             'nama'        => $this->request->getPost('nama'),
             'kelas_id'        => $this->request->getPost('kelas_id'),
             'alamat'        => $this->request->getPost('alamat'),
             'telp'        => $this->request->getPost('telp'),
             'level'        => $this->request->getPost('level'),
         );
         $this->siswaModel->updateSiswa($data, $nisn);
         session()->setFlashdata('edt', 'Siswa berhasil diubah');
         return redirect()->to(base_url('siswaAdmin'));
     }

   
     //hapus data siswa
     public function hapusSis($nisn)
     {
         $this->siswaModel->delete($nisn);
         session()->setFlashdata('hps', 'Siswa telah dihapus');
         return redirect()->to(base_url('siswaAdmin'));
     }

     //section petugas
     public function petugas()
    {
        $petugas = $this->petugasModel->findAll();
        $data = [
            'title' => 'Data Petugas | V-SPP',
            'petugas' => $petugas,
        ];

        return view('pages/admin/petugas/index', $data);
    }

    //function insert petugas
    public function tambahPet(){
        $data = array(
            'id' => $this->request->getVar('id'),
            'nama_petugas' => $this->request->getVar('nama_petugas'),
            'username' => $this->request->getVar('username'),
            'password' => sha1($this->request->getVar('password')),
            'level' => $this->request->getVar('level'),
            'status' => $this->request->getVar('status'),
        );

        $this->petugasModel->saveUser($data);
        session()->setFlashdata('tmb', 'Petugas Berhasil Ditambah');
        return redirect()->to(base_url('petugasAdmin'));
    }

    //tampilan edit petugas
    public function editPet()
     {
         $id = $this->request->getPost('id');
         $data = array(
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'level' => $this->request->getPost('level'),
            'status' => $this->request->getPost('status'),
         );
         $this->petugasModel->updateUser($data, $id);
         session()->setFlashdata('edt', 'Petugas berhasil diubah');
         return redirect()->to(base_url('petugasAdmin'));
     }

     //mengeksekusi query update
     public function updatePet($id)
     {
         helper(['form', 'url']);
 
         $validation = $this->validate([
             'username' => [
                 'rules'  => 'required',
                 'errors' => [
                     'required' => 'Masukkan Nama Username'
                 ]
             ],
         ]);
 
         if (!$validation) {
 
             //model initialize
             $petugasModel = new PetugasModel();
 
             //render view with error validation message
             return view('petugas', [
                 'edit' => $petugasModel->find($id),
                 'validation' => $this->validator
             ]);
         } else {
 
             //model initialize
             $petugasModel = new PetugasModel();
 
             //insert data into database
             $petugasModel->update($id, [
                 'id'   => $this->request->getPost('id'),
                 'nama_petugas' => $this->request->getPost('nama_petugas'),
                 'username' => $this->request->getPost('username'),
                 'password' => $this->request->getPost('password'),
                 'level' => $this->request->getPost('level'),
                 'status' => $this->request->getPost('status'),
             ]);
 
             //flash message
             session()->setFlashdata('edt', 'Petugas Berhasil Diupdate');
 
             return redirect()->to(base_url('petugasAdmin'));
         }
     }

     //query hapus petugas
     public function hapusPet($id)
     {
         $this->petugasModel->delete($id);
         session()->setFlashdata('hps', 'Kelas telah dihapus');
         return redirect()->to(base_url('petugasAdmin'));
     }

     //section transaksi
     public function transaksi()
    {
        $spp = $this->sppModel->findAll();
        $petugas = $this->petugasModel->findAll();
        $siswa = $this->siswaModel->getData();
        $data = [
            'title' => 'Transaksi | V-SPP',
            'siswa' => $siswa,
            'spp' => $spp,
            'petugas' => $petugas
        ];

        return view('pages/admin/transaksi/index', $data);
    }

    //function tambah transaksi
    public function tambahTrans(){
        $data = array(
            'id' => $this->request->getVar('id'),
            'petugas_id' => $this->request->getVar('petugas_id'),
            'nama' => $this->request->getVar('nama'),
            'nisn' => $this->request->getVar('nisn'),
            'tgl_bayar'=> $this->request->getVar('tgl_bayar'),
            'bln_bayar'=> $this->request->getVar('bln_bayar'),
            'th_bayar'=> $this->request->getVar('th_bayar'),
            'spp_id'=> $this->request->getVar('spp_id'),
            'jml_bayar'=> $this->request->getVar('jml_bayar'),
            'ket'=> $this->request->getVar('ket'),
        );

        $this->transModel->saveTrans($data);
        session()->setFlashdata('tmb', 'Riwayat Berhasil Ditambah');
        return redirect()->to(base_url('riwayatAdmin'));
    }

    public function editTrans()
    {
        $id = $this->request->getPost('id');
        $data = array(
           'nama' => $this->request->getPost('nama'),
           'nisn' => $this->request->getPost('nisn'),
           'tgl_bayar' => $this->request->getPost('tgl_bayar'),
           'bln_bayar' => $this->request->getPost('bln_bayar'),
           'th_bayar' => $this->request->getPost('th_bayar'),
           'spp_id' => $this->request->getPost('spp_id'),
           'jml_bayar' => $this->request->getPost('jml_bayar'),
           'ket' => $this->request->getPost('ket'),
           'petugas_id' => $this->request->getPost('petugas_id'),
        );
        $this->transModel->updateTrans($id, $data);
        session()->setFlashdata('edt', 'Riwayat berhasil diubah');
        return redirect()->to(base_url('riwayatAdmin'));
    }

    //mengeksekusi query update
    public function updateTransaksi($id)
    {
        helper(['form', 'url']);

        $validation = $this->validate([
            'nisn' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan NISN'
                ]
            ],
        ]);

        if (!$validation) {

            //model initialize
            $transModel = new TransaksiModel();

            //render view with error validation message
            return view('riwayatAdmin', [
                'edit' => $transModel->find($id),
                'validation' => $this->validator
            ]);
        } else {

            //model initialize
            $transModel = new TransaksiModel();

            //insert data into database
            $transModel->update($id, [
                'id' => $this->request->getPost('id'),
                'petugas_id' => $this->request->getPost('petugas_id'),
                'nama' => $this->request->getPost('nama'),
                'nisn' => $this->request->getPost('nisn'),
                'tgl_bayar' => $this->request->getPost('tgl_bayar'),
                'bln_bayar' => $this->request->getPost('bln_bayar'),
                'th_bayar' => $this->request->getPost('th_bayar'),
                'spp_id' => $this->request->getPost('spp_id'),
                'jml_bayar' => $this->request->getPost('jml_bayar'),
                'ket' => $this->request->getPost('ket'),
            ]);

            //flash message
            session()->setFlashdata('edt', 'Riwayat Berhasil Diupdate');

            return redirect()->to(base_url('riwayatAdmin'));
        }
    }

    //hapus transaksi
    public function hapusTrans($id)
    {
        $this->transModel->delete($id);
        session()->setFlashdata('hps', 'Transaksi telah dihapus');
        return redirect()->to(base_url('riwayatAdmin'));
    }

    //section riwayat
    public function riwayat()
    {
        $riwayat = $this->transModel->getData();
        $spp = $this->sppModel->findAll();
        $petugas = $this->petugasModel->findAll();
        $data = [
            'title' => 'Riwayat Transaksi | V-SPP',
            'riwayat' => $riwayat,
            'spp' => $spp,
            'petugas' => $petugas
        ];

        return view('pages/admin/riwayat/index', $data);
    }

    public function cetakAdmin()
    {
        $riwayat = $this->transModel->getData();
        $data = [
            'title' => 'Cetak Riwayat Transaksi | V-SPP',
            'riwayat' => $riwayat,
        ];

        return view('pages/admin/riwayat/cetak', $data);
    }
}
