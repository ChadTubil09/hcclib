<?php
namespace App\Models;
use \CodeIgniter\Model;

class UsersModel extends Model 
{
    protected $table = 'users';
    protected $primaryKey = 'uid';
    protected $allowedFields = [
        'username', 'password', 'userposid', 'name',
        'email', 'mobile', 'status', 'isdel',
        'acbooks', 'acborrow', 'acreturn', 'aclogs', 'acsystem',
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