<?php
namespace App\Models;
use \CodeIgniter\Model;

class EBooksModel extends Model 
{
    protected $table = 'ebooks';
    protected $primaryKey = 'ebid';
    protected $allowedFields = [
        'ebtitle', 'ebauthors', 'eblink', 'ebstatus', 'ebisdel',
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