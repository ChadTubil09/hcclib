<?php
namespace App\Models;
use \CodeIgniter\Model;

class BorrowModel extends Model 
{
    protected $table = 'borrow';
    protected $primaryKey = 'borrowid';
    protected $allowedFields = [
        'baccid', 'name',
        'studentno', 'grade', 'section', 'duedateofreturn', 'contactno', 'borrowdate', 'returndate',
        'status',
    ];
    protected $returnType = 'array';

}