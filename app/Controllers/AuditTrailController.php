<?php

namespace App\Controllers;
use App\Models\AuditTrailModel;
use App\Models\UsersModel;
use \CodeIgniter\View\Table;
class AuditTrailController extends BaseController
{
    public $atModel;
    public $usersModel;
    public function __construct() {
        helper('form');
        $this->atModel = new AuditTrailModel();
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | Audit Trail',
            'page_heading' => 'AUDIT TRAIL',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->atModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();
        
        $data['at'] = $this->atModel->findAll();
        $data['userslist'] = $this->usersModel->findAll();

        return view('audittrailview', $data);
        
    }
}
