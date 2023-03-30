<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;
use App\Models\SiswaModel;
use App\Models\TransaksiModel;

$request = \Config\Services::request();

class Siswa extends BaseController
{
    protected $transModel;
    public function __construct()
    {
        $this->transModel = new TransaksiModel();
    }

    public function index()
    {
        if(session('level') != 'SISWA'){
            session()->setFlashdata('belum', "Kamu Belum Melakukan Login");
            return redirect()->to(base_url('/'));
        }
        
        $data = [
            'title' => 'Dashboard Siswa | V-SPP',
          
        ];
        return view('pages/siswa/index', $data);
    }

    public function getNisn($nisn){
        $transaksi = $this->transModel->getById($nisn);
        return redirect()->to(base_url('transaksi'));
    }


    public function history()
    {
        $result = $this->transModel->getNisn();
        $data = [
            'title' => 'History Pembayaran | V-SPP',
            'result' => $result
        ];
        return view('pages/siswa/riwayat/index', $data);
    }

    public function cetakSiswa()
    {
        $result = $this->transModel->getNisn();
        $data = [
            'title' => 'Cetak Riwayat Transaksi | V-SPP',
            'result' => $result
        ];

        return view('pages/siswa/riwayat/cetak', $data);
    }
}
