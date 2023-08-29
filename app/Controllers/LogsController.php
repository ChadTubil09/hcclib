<?php

namespace App\Controllers;
use App\Models\BooksModel;
use App\Models\BorrowModel;
use App\Models\CategoryModel;
use App\Models\UsersModel;
use App\Models\AccessionModel;
class LogsController extends BaseController
{
    public $booksModel;
    public $catModel;
    public $borrowModel;
    public $usersModel;
    public $accessionModel;
    public function __construct() {
        helper('form');
        $this->booksModel = new BooksModel();
        $this->catModel = new CategoryModel();
        $this->borrowModel = new BorrowModel();
        $this->usersModel = new UsersModel();
        $this->accessionModel = new AccessionModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | Logs',
            'page_heading' => 'LOGS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->booksModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();
        
        $bookCondition = array('status' => 0);
        $data['booklist'] = $this->booksModel->where($bookCondition)->findAll();
        $data['catlist'] = $this->catModel->where('isdel', 0)->findAll();
        $data['borrowlist'] = $this->borrowModel->findAll();
        $data['accessionlist'] = $this->accessionModel->where('isdel', '0')->findAll();

        return view('logview', $data);
    }
}
