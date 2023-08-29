<?php
namespace App\Models;
use \CodeIgniter\Model;

class BooksModel extends Model 
{
    protected $table = 'books';
    protected $primaryKey = 'bookid';
    protected $allowedFields = [
        'title', 'authors', 'edition', 'authors', 'publication',
        'placeofpub', 'dateofpub', 'description', 'subaddedentry', 'notes',
        'contents', 'image', 'bookcatid', 'copies', 'status', 'isdel',
        'isbn', 'issn', 'callnumber',
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