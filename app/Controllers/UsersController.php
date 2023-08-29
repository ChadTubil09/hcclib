<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\PositionModel;
use App\Models\AuditTrailModel;
use \CodeIgniter\View\Table;
class UsersController extends BaseController
{
    public $usersModel;
    public $posModel;
    public $atModel;
    public function __construct() {
        helper('form', 'date');
        //$this->dModel = new DashboardModel();
        $this->usersModel = new UsersModel();
        $this->posModel = new PositionModel();
        $this->atModel = new AuditTrailModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | Users',
            'page_heading' => 'USERS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();

        $userCondition = array('isdel' => 0, 'uid !=' => $uid);
        $data['userslist'] = $this->usersModel->where($userCondition)->findAll();
        $data['poslist'] = $this->posModel->where('posisdel', 0)->findAll();

        if($this->request->getMethod() == 'post') {
            $rules = [
                'username' => [
                    'rules' => 'required|min_length[4]|max_length[16]|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username is required.',
                        'min_length' => 'The username must be atleast 4 characters.',
                        'max_length' => 'The username must be atleast 16 characters.',
                        'is_unique' => 'This username is already exists or check the archive.',
                    ],
                ],
                'password' => [
                    'rules' => 'required|min_length[6]|max_length[16]',
                    'errors' => [
                        'required' => 'Password is required.',
                        'min_length' => 'The password must be atleast 6 characters.',
                        'max_length' => 'The password must be atleast 16 characters.',
                    ],
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Name is required.',],
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email Address is required.',
                        'valid_email' => 'Use a valid email address.'
                    ],
                ],
                'mobile' => [
                    'rules' => 'required|numeric|exact_length[11]',
                    'errors' => [
                        'required' => 'Contact number is required.',
                        'numeric' => 'Contact number must contain numbers only.',
                        'exact_length' => 'The contact number must be 11 numbers.',
                    ]
                ],
            ];
            if($this->validate($rules))
            {
                $udata = [
                    'username' =>$this->request->getVar('username'),
                    'password' =>$this->request->getVar('password'),
                    'userposid' => '0',
                    'name' =>$this->request->getVar('name'),
                    'email' =>$this->request->getVar('email'),
                    'mobile' =>$this->request->getVar('mobile'),
                    'status' => '1',
                    'isdel' => '0',
                ];
                if($this->usersModel->save($udata) === true){
                    $atdata = [
                        'atuid' => $uid,
                        'ataction' => 'Add',
                        'atmessage' => 'Add a new user ('.$udata['name'].')',
                        'atdatetime' => date('Y-m-d H:i:s'),
                        
                    ];
                    $this->atModel->save($atdata);
                    session()->setTempdata('success','User added successfully', 3);
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

        return view('usersview', $data);
    }
    public function deleteUser($id=null) {
        $data = [
            'isdel' => '1',
        ];

        if($this->usersModel->where('uid', $id)->update($id, $data)){
            $uid = session()->get('logged_user');
            $getnameofuser = $this->usersModel->where('uid', $id)->findAll();
            foreach ($getnameofuser as $nameofuser)
            {
                $nameuser = $nameofuser['name'];
            }
            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Delete',
                'atmessage' => 'Deleted a user ('.$nameuser.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('deletesuccess', 'User deleted!', 2);
            return redirect()->to(base_url()."users"); 
        }
        
    }
    public function userAccess($id=null) {
        if($this->request->getMethod() == 'post') {
            $data = [
                'userposid' => $this->request->getVar('selposition'),
                'acbooks' => $this->request->getVar('acbooks'),
                'acreturn' => $this->request->getVar('acreturn'),
                'aclogs' => $this->request->getVar('aclogs'),
                'acsystem' => $this->request->getVar('acsystem'),
                'acborrow' => $this->request->getVar('acborrow'),
                'status' => '0',
            ];

            if($this->usersModel->where('uid', $id)->update($id, $data)) {
                $uid = session()->get('logged_user');
                $getnameofuser = $this->usersModel->where('uid', $id)->findAll();
                foreach ($getnameofuser as $nameofuser)
                {
                    $nameuser = $nameofuser['name'];
                }
                $atdata = [
                    'atuid' => $uid,
                    'ataction' => 'Access',
                    'atmessage' => 'Give a user access to ('.$nameuser.')',
                    'atdatetime' => date('Y-m-d H:i:s'),
                    
                ];
                $this->atModel->save($atdata);
                session()->setTempdata('deletesuccess', 'User has access!', 2);
                return redirect()->to(base_url()."users"); 
            }
        }
        
    }
    public function userUpdate($id=null) {
        if($this->request->getMethod() == 'post') {
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'mobile' => $this->request->getVar('mobile'),
                'username' => $this->request->getVar('username'),
                'password' => $this->request->getVar('password'),
            ];

            if($this->usersModel->where('uid', $id)->update($id, $data)) {
                $uid = session()->get('logged_user');
                $getnameofuser = $this->usersModel->where('uid', $id)->findAll();
                foreach ($getnameofuser as $nameofuser)
                {
                    $nameuser = $nameofuser['name'];
                }
                $atdata = [
                    'atuid' => $uid,
                    'ataction' => 'Update',
                    'atmessage' => 'Updated a user ('.$nameuser.')',
                    'atdatetime' => date('Y-m-d H:i:s'),
                    
                ];
                $this->atModel->save($atdata);
                session()->setTempdata('deletesuccess', 'Update Successful!', 2);
                return redirect()->to(base_url()."users"); 
            }
        }
        
    }
}
