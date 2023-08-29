<?php
namespace App\Models;
use \CodeIgniter\Model;

class AccessionModel extends Model 
{
    protected $table = 'accession';
    protected $primaryKey = 'accid';
    protected $allowedFields = [
        'accno', 'accbookid', 'status', 'isdel',
    ];
    protected $returnType = 'array';

}