<?php
namespace App\Models;
use \CodeIgniter\Model;

class AuditTrailModel extends Model 
{
    protected $table = 'audittrail';
    protected $primaryKey = 'atid';
    protected $allowedFields = [
        'atuid', 'ataction', 'atmessage', 'atdatetime',
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