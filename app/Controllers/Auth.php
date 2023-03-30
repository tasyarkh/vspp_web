<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;
use App\Models\PetugasModel;
use App\Models\SiswaModel;

$request = \Config\Services::request();

class Auth extends BaseController
{
    protected $petugasModel;
    protected $siswaModel;
    public function __construct()
    {
        $this->petugasModel = new PetugasModel(); //meninisialisasikan loginModel dari data user model
        $this->siswaModel = new SiswaModel();
    }

    //section login petugas & admin
    public function login()
    {
        $data = [
            'title' => 'Login Petugas | V-SPP',

        ];
        return view('pages/auth/loginPetugas', $data);
    }

    //query untuk cek login
    public function checkLogin()
    {
        $username = $this->request->getPost('username');
        $password = sha1($this->request->getPost('password'));

        $row = $this->petugasModel->check($username, $password); //mengambil parameter method check di PetugasModel

        if (isset($row['username'], $row['password'])) {
            if (($row['username'] == $username) && ($row['password'] == $password)) {
                if (($row['status'] == "AKTIF") && ($row['level'] == "ADMIN")) {
                    session()->set('nama_petugas', $row['nama_petugas']);
                    session()->set('username', $row['username']);
                    session()->set('level', $row['level']);
                    session()->setFlashdata('berhasil', 'Selamat Anda Telah Login');
                    return redirect()->to(base_url('dashAdmin'));
                } else 
                if (($row['status'] == "AKTIF") && ($row['level'] == "PETUGAS")) {
                    session()->set('nama_petugas', $row['nama_petugas']);
                    session()->set('username', $row['username']);
                    session()->set('level', $row['level']);
                    session()->setFlashdata('berhasil', 'Selamat Anda Berhasil Login');
                    return redirect()->to(base_url('dashPetugas'));
                }else{
                    session()->setFlashdata('tidakAktif', 'Akun anda belum aktif');
                    return redirect()->to(base_url('/'))->withInput();
                }
            }
        } else {
            session()->setFlashdata('gagal', 'Username atau Password salah !');
            return redirect()->to(base_url('/'))->withInput();
        }
    }

    //function logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }

    //section login siswa
    public function loginSiswa()
    {
        $data = [
            'title' => 'Login Siswa | V-SPP',

        ];
        return view('pages/auth/loginSiswa', $data);
    }

    //function cek login siswa
    public function checkSiswa()
    {
        $nisn = $this->request->getPost('nisn');
        $nama = $this->request->getPost('nama');

        $row = $this->siswaModel->checkSiswa($nisn, $nama); //mengambil parameter method check di siswaModel

        if (isset($row['nisn'], $row['nama'])) {
            if (($row['nisn'] == $nisn) && ($row['nama'] == $nama)) {
                if (($row['level'] == "SISWA")) {
                    session()->set('nisn', $row['nisn']);
                    session()->set('nis', $row['nis']);
                    session()->set('nama', $row['nama']);
                    session()->set('kelas_id', $row['kelas_id']);
                    session()->set('alamat', $row['alamat']);
                    session()->set('telp', $row['telp']);
                    session()->set('level', $row['level']);
                    session()->setFlashdata('berhasil', 'Selamat Anda Telah Login');
                    return redirect()->to(base_url('historySiswa'));
                }
            }
        } else {
            session()->setFlashdata('gagal', 'Username atau Password salah !');
            return redirect()->to(base_url('loginSiswa'))->withInput();
        }
    }
}
