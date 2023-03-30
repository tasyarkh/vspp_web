<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'siswa';
    protected $primaryKey       = 'nisn';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["nis","nama","kelas_id","alamat","telp","spp_id","level"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //function untuk login siswa
    public function checkSiswa($nisn, $nama){
        return $this->db->table('siswa')->where(
            array(
                'nisn' => $nisn,
                'nama' => $nama,
            )
        )
        ->get()->getRowArray();
    }

    //mengambil data siswa dari db siswa
    public function getSiswa($nisn = false){
        if($nisn === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['nisn' => $nisn]);
        }
    }

    //function insert data siswa
    public function saveSiswa($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    //function update data siswa
    public function updateSiswa($data, $nisn)
    {
        $query = $this->db->table($this->table)->update($data, array('nisn' => $nisn));
        return $query;
    }

    //query builder jumlah siswa
    public function countSiswa(){
        $builder = $this->db->table('siswa');
        $query = $builder->countAllResults();
        return $query;
    }

    public function getData()
    {
        return $this->select('siswa.*, kelas.*')
            ->join('kelas', 'siswa.kelas_id = kelas.id')
            ->get()
            ->getResultArray();
               
    }
}
