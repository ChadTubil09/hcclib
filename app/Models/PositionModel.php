<?php
namespace App\Models;
use \CodeIgniter\Model;

class PositionModel extends Model {
    protected $table = 'position';
    protected $primaryKey = 'posid';
    protected $allowedFields = ['posname', 'posisdel'];
    protected $returnType = 'array';

    public function getLoggedInUserData($uid){
        $builder = $this->db->table('users');
        $builder->where('uid', $uid);
        $result = $builder->get();
        if(count($result->getResultArray())==1){
            return $result->getRow();
        }
        else{
            return false;
        }
    }
    
}