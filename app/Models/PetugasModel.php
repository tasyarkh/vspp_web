<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'petugas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //method proses cek login
    public function check($username, $password){
        return $this->db->table('petugas')->where(
            array(
                'username' => $username,
                'password' => $password,
            )
        )
        ->get()->getRowArray();
    }

    //function untuk insert data user
    public function saveUser($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    //function untuk update user
    public function updateUser($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    //
    public function getUser($id = false){
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    //query builder jumlah petugas
    public function countPetugas(){
        $builder = $this->db->table('petugas');
        $query = $builder->countAllResults();
        return $query;
    }
}
