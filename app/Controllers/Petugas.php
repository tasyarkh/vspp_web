<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\SiswaModel;
use App\Models\SppModel;
use App\Models\PetugasModel;

class Petugas extends BaseController
{
    protected $transModel;
    protected $siswaModel;
    protected $sppModel;
    protected $petugasModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->transModel = new TransaksiModel();
        $this->siswaModel = new SiswaModel();
        $this->sppModel = new SppModel();
        $this->petugasModel = new PetugasModel();
    }
    
    //section dashboard
    public function index()
    {
        if(session('level') != 'PETUGAS'){
            session()->setFlashdata('belum', "Kamu Belum Melakukan Login");
            return redirect()->to(base_url('/'));
        }

        $trans = $this->transModel->countTrans();

        $data = [
            'title' => 'Petugas | V-SPP',
            'trans' => $trans
        ];

        return view('pages/petugas/index', $data);
    }

    //section transaksi
    public function transaksi()
    {
        $spp = $this->sppModel->findAll();
        $siswa = $this->siswaModel->getData();
        $petugas = $this->petugasModel->findAll();
        $data = [
            'title' => 'Transaksi | V-SPP',
            'siswa' => $siswa,
            'spp' => $spp,
            'petugas' => $petugas
        ];
        return view('pages/petugas/transaksi/index', $data);
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
        return redirect()->to(base_url('riwayatPetugas'));
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
        return redirect()->to(base_url('riwayatPetugas'));
    }

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
        return redirect()->to(base_url('riwayatPetugas'));
    }

    //section history
    public function history()
    {
        $riwayat = $this->transModel->getData();
        $petugas = $this->petugasModel->findAll();
        $spp = $this->sppModel->findAll();
        $data = [
            'title' => 'History Pembayaran | V-SPP',
            'riwayat' => $riwayat,
            'petugas' => $petugas,
            'spp' => $spp
        ];
        return view('pages/petugas/riwayat/index', $data);
    }

    public function cetakPetugas()
    {
        $riwayat = $this->transModel->getData();
        $data = [
            'title' => 'Cetak Riwayat Transaksi | V-SPP',
            'riwayat' => $riwayat,
        ];

        return view('pages/petugas/riwayat/cetak', $data);
    }
}
