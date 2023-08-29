<?php

namespace App\Controllers;
use App\Models\AuditTrailModel;
use App\Models\PositionModel;
use \CodeIgniter\View\Table;
use App\Models\UsersModel;
class PositionController extends BaseController
{
    public $atModel;
    public $posModel;
    public $usersModel;
    public function __construct() {
        helper('form');
        $this->atModel = new AuditTrailModel();
        $this->posModel = new PositionModel();
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | Positions',
            'page_heading' => 'POSITIONS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');

        // $userdata = $this->dModel->getLoggedInUserData($uid);
        // print_r($userdata);
        //$data['userdata'] = $this->dModel->getLoggedInUserData($uid);

        $data['userdata'] = $this->posModel->getLoggedInUserData($uid);
        $data['pos'] = $this->posModel->where('posisdel', 0)->findAll();
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();
        
        if($this->request->getMethod() == 'post') {
            $rules = [
                'position' => [
                    'rules' => 'required|is_unique[position.posname]',
                    'errors' => [
                        'required' => 'Position is required.',
                        'is_unique' => 'This position is already exists or check the archive.',
                    ],
                ],
            ];
            if($this->validate($rules))
            {
                $udata = [
                    'posname' => $this->request->getVar('position'),
                    'posisdel' => '0',
                ];
                if($this->posModel->save($udata) === true){
                    $atdata = [
                        'atuid' => $uid,
                        'ataction' => 'Add',
                        'atmessage' => 'Add a position ('.$udata['posname'].')',
                        'atdatetime' => date('Y-m-d H:i:s'),
                        
                    ];
                    $this->atModel->save($atdata);
                    session()->setTempdata('success','Position added successfully', 3);
                    return redirect()->to(current_url());
                }
                // print_r($udata);
                // print_r($data);
            }
            else
            {
                $data['validation'] = $this->validator;
            }
            
        }

        return view('positionview', $data);
    }
    public function deletePosition($id=null) {
        $data = [
            'posisdel' => '1',
        ];

        if($this->posModel->where('posid', $id)->update($id, $data)){
            $uid = session()->get('logged_user');
            $getnameofposition = $this->posModel->where('posid', $id)->findAll();
            foreach ($getnameofposition as $nameofposition)
            {
                $nameposition = $nameofposition['posname'];
            }
            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Delete',
                'atmessage' => 'Deleted a position ('.$nameposition.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('deletesuccess', 'Position deleted!', 2);
            return redirect()->to(base_url()."position"); 
        }
        
    }
    public function positionUpdate($id=null) {
        if($this->request->getMethod() == 'post') {
            $data = [
                'posname' => $this->request->getVar('name'),
            ];

            if($this->posModel->where('posid', $id)->update($id, $data)) {
                $uid = session()->get('logged_user');
                $getnameofposition = $this->posModel->where('posid', $id)->findAll();
                foreach ($getnameofposition as $nameofposition)
                {
                    $nameposition = $nameofposition['posname'];
                }
                $atdata = [
                    'atuid' => $uid,
                    'ataction' => 'Update',
                    'atmessage' => 'Updated a position ('.$nameposition.')',
                    'atdatetime' => date('Y-m-d H:i:s'),
                    
                ];
                $this->atModel->save($atdata);
                session()->setTempdata('deletesuccess', 'Update Successful!', 2);
                return redirect()->to(base_url()."position"); 
            }
        }
        
    }
}
