<?php
namespace App\Models;
use \CodeIgniter\Model;

class CategoryModel extends Model 
{
    protected $table = 'category';
    protected $primaryKey = 'catid';
    protected $allowedFields = [
        'catname', 'isdel',
    ];
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