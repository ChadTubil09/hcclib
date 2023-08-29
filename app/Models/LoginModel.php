<?php
namespace App\Models;
use \CodeIgniter\Model;

class LoginModel extends Model {
    public function verifyUser($user){

        $builder = $this->db->table('users');
        $builder->select("uid, status, username, password");
        $builder->where('username', $user);

        // $array = array('username' => $user, 'password' => $password);
        // $builder->where($array);

        $result = $builder->get();
        if(count($result->getResultArray())==1)
        {
            return $result->getRowArray();
        }
        else
        {
            return false;
        }
    }
    // public function verifyPassword($password){

    //     $builder = $this->db->table('users');
    //     $builder->select("uid, status, username, password");
    //     $builder->where('password', $password);
    //     $result = $builder->get();
    //     if(count($result->getResultArray())==1)
    //     {
    //         return $result->getRowArray();
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // }
}