<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth_Model extends Model
{
    
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'email' , 'password'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function register($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false ;
    }

    public function login($email)
    {

        $query = $this->db->table('admin')->where('username', $email)->countAll();
        if ($query > 0) {
            $get_data = $this->db->table($this->table)
                            ->where('username', $email)
                            ->limit(1)
                            ->get()
                            ->getRowArray();
        } else {
            $get_data = [];
        }
        return $get_data;
    }

    public function updateData($email, $postData)
    {
        return $query = $this->db->table($this->table)->where('email', $email)->update($postData);
    }

    public function resetPassword($token, $postData)
    {
        return $query = $this->db->table($this->table)->where('token', $token)->update($postData);
    }

    public function add($table_name, $data)
    {
        $query = $this->db->table($table_name)->insert($data);
        return $query ? true : false ;
    }

    public function edit($table_name, $where, $postData)
    {
        return $query = $this->db->table($table_name)->where($where)->update($postData);
    }

    public function get($table_name, $where = "")
    {
        if ($where) {
            return $query = $this->db->table($table_name)->where($where)->get()->getRow();
        } else {
            return $query = $this->db->table($table_name)->get()->getResult();
        }
    }

    public function deleteData($table_name, $where)
    {
        return $query = $this->db->table($table_name)->where($where)->delete();
    }

    public function getCount($table_name, $where = "")
    {
        return $query = $this->db->table($table_name)->where($where)->get()->getResult();
    }

    public function getResult($table_name, $where = "")
    {
        if ($where) {
            return $query = $this->db->table($table_name)->where($where)->get()->getResult();
        } else {
            return $query = $this->db->table($table_name)->get()->getResult();
        }
    }
}
