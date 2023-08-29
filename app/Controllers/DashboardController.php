<?php

namespace App\Controllers;
use App\Models\DashboardModel;
use App\Models\UsersModel;
use App\Models\BooksModel;
use App\Models\BorrowModel;
use App\Models\EBooksModel;
use App\Models\AccessionModel;
class DashboardController extends BaseController
{
    public $dModel;
    public $booksModel;
    public $usersModel;
    public $ebooksModel;
    public $borrowModel;
    public $accessionModel;
    public function __construct() {
        $this->dModel = new DashboardModel();
        $this->booksModel = new BooksModel();
        $this->usersModel = new UsersModel();
        $this->borrowModel = new BorrowModel();
        $this->ebooksModel = new EBooksModel();
        $this->accessionModel = new AccessionModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | Dashboard',
            'page_heading' => 'DASHBOARD',
            
        ];

        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');

        // $userdata = $this->dModel->getLoggedInUserData($uid);
        // print_r($userdata);
        $data['userdata'] = $this->dModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();

        $data['countbooks'] = $this->booksModel->where('isdel', '0')->countAllResults();
        
        $this->booksModel->selectSum('copies');
        $result = $this->booksModel->get()->getRow();
        $data['sum'] = $result->copies;

        $data['countborrow'] = $this->borrowModel->where('status', '0')->countAllResults();

        $data['countebooks'] = $this->ebooksModel->where('ebisdel', '0')->countAllResults();

        $data['borrowed'] = $this->borrowModel->where('status', '0')
                                            ->orderBy('borrowdate', 'asc')
                                            ->limit(5)
                                            ->findAll();
    
        $duebarrowCondition = array('duedateofreturn' => date('Y-m-d'), 'status' => 0);
        $data['borroweddue'] = $this->borrowModel->where($duebarrowCondition)
                                                ->limit(5)
                                                ->findAll();
        
        $overduebarrowCondition = array('duedateofreturn <' => date('Y-m-d'), 'status' => 0);
        $data['borrowedoverdue'] = $this->borrowModel->where($overduebarrowCondition)
                                                ->limit(5)
                                                ->findAll();

        $data['booklist'] = $this->booksModel->findAll();
        $data['acclist'] = $this->accessionModel->findAll();

        echo view('dashboardview', $data);
    }

    public function logout() 
    {
        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to(base_url()."admin");
    }

    
}
