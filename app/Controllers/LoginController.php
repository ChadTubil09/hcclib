<?php

namespace App\Controllers;
use App\Models\LoginModel;
class LoginController extends BaseController
{
    public $loginModel;
    public $session;

    public function __construct()
    {
        helper('form');
        $this->loginModel = new LoginModel();
        $this->session = session();
    }

    public function index()
    {
        $data = [];
        if($this->request->getMethod() == 'post')
        {
            $rules = [
                'user' => 'required|min_length[4]|max_length[16]',
                'pass' => 'required|min_length[6]|max_length[16]',
            ];
            if($this->validate($rules))
            {
                $user = $this->request->getVar('user');
                $password = $this->request->getVar('pass');

                $userdata =  $this->loginModel->verifyUser($user);
                // print_r($userdata);
                // ------------------------------------------
                if($user == $userdata['username'])
                {
                    
                    if($password == $userdata['password']){
                        // print_r($userdata);
                        if($userdata['status'] == '0'){
                            $loginInfo = [];
                            $this->session->set('logged_user', $userdata['uid']);
                            return redirect()->to(base_url().'dashboard');
                        }
                        else{
                            $this->session->setTempdata('error','Please contact administrator', 3);
                            return redirect()->to(current_url());
                        }
                    }
                    else{
                        $this->session->setTempdata('error','Sorry! Wrong password', 3);
                        return redirect()->to(current_url());
                    }

                    // ------------------------------------------

                    // print_r($userdata);
                    // $userpassword =  $this->loginModel->verifyPassword($password);
                    // if($userpassword){

                    //     // $loginInfo = [];
                    //     // $this->session->set('logged_user', $userpassword['uid']);
                    //     // return redirect()->to(base_url().'dashboard');
                    //     // print_r($userpassword);

                    //     if($userpassword['status']=='0')
                    //     {
                    //         $loginInfo = [];
                    //         $this->session->set('logged_user', $userpassword['uid']);
                    //         return redirect()->to(base_url().'dashboard');
                    //     }
                    //     else
                    //     {
                    //         $this->session->setTempdata('error','Please contact administrator', 3);
                    //         return redirect()->to(current_url());
                    //     }
                    // }else
                    // {
                    //     $this->session->setTempdata('error','Sorry! Wrong password', 3);
                    //     return redirect()->to(current_url());
                    // }

                    // $loginInfo = [];
                    // $this->session->set('logged_user', $userpassword['uid']);
                    // return redirect()->to(base_url().'dashboard');
                }
                else
                {
                        $this->session->setTempdata('error','Sorry! User does not exists', 3);
                        return redirect()->to(current_url());
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('loginview', $data);
    }
}
