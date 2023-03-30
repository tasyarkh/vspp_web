<?php

namespace App\Models;

use CodeIgniter\Model;

class SppModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'spp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["tahun","bulan","nominal"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //mengambil data dari db spp
    public function getSpp($id = false){
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    //function untuk insert data spp
    public function saveSpp($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    //function update data spp
    public function updateSpp($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    //query builder jumlah spp
    public function countSpp(){
        $builder = $this->db->table('spp');
        $query = $builder->countAllResults();
        return $query;
    }

    public function get_spp()
    {
    return $this->db->table('spp')->get()->getResultArray(); 
    }
}
