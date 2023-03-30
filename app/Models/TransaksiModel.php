<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["id","petugas_id","nama","nisn","tgl_bayar","bln_bayar","th_bayar","spp_id","jml_bayar","ket"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getTrans($id = false){
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    //function insert data transaksi
    public function saveTrans($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    //function update data transaksi
    public function updateTrans($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    // public function updateTrans($data, $id)
    // {
    //     return $this->update('transaksi')
    //         ->set($data)
    //         ->where('id', $id)
    //         ->getResultArray();
    // }

     //query builder jumlah siswa
     public function countTrans(){
        $builder = $this->db->table('transaksi');
        $query = $builder->countAllResults();
        return $query;
    }

    // public function getById($nisn)
    // {
    //     $transaksi = $this->db->table('transaksi')
    //         ->select('transaksi.*')
    //         ->where('transaksi.nisn', $nisn)
    //         ->get()
    //         ->getRowArray();

    //     if (!empty($transaksi)) {
    //         return $transaksi;
    //     } else {
    //         return null;
    //     }
    // }

    public function getNisn()
    {
        $nisn = session()->get('nisn'); //diganti dengan nama session nisn yang digunakan pada aplikasi
        return $this->select('transaksi.*, spp.*, petugas.nama_petugas')
        ->join('spp', 'transaksi.spp_id = spp.id')
        ->join('petugas', 'transaksi.petugas_id = petugas.id')
        ->where('nisn', $nisn)
        ->get()
        ->getResultArray();
    }

    public function getData()
    {
        return $this->select('transaksi.*, spp.*, petugas.nama_petugas')
            ->join('spp', 'transaksi.spp_id = spp.id')
            ->join('petugas', 'transaksi.petugas_id = petugas.id')
            ->get()
            ->getResultArray();
               
    }

}
