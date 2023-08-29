<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\EBooksModel;
use App\Models\AuditTrailModel;
class EBooksController extends BaseController
{
    public $usersModel;
    public $ebooksModel;
    public $atModel;
    public function __construct() {
        helper('form');
        $this->usersModel = new UsersModel();
        $this->ebooksModel = new EBooksModel();
        $this->atModel = new AuditTrailModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | E-Books',
            'page_heading' => 'E-Books',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();

        $ebookCondition = array('ebisdel' => 0, 'ebstatus' => 0);
        $data['ebooklist'] = $this->ebooksModel->where($ebookCondition)->findAll();

        if($this->request->getMethod() == 'post') {
            $rules = [
                'ebtitle' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'E-Book Title is required.'
                    ],
                ],
                'ebauthors' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'E-Book Author/s is required.'
                    ],
                ],
                'eblink' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'E-Book Link is required.'
                    ],
                ],
            ];
            if($this->validate($rules))
            {
                $bdata = [
                    'ebtitle' => $this->request->getVar('ebtitle'),
                    'ebauthors' => $this->request->getVar('ebauthors'),
                    'eblink' => $this->request->getVar('eblink'),
                    'ebstatus' => '0',
                    'ebisdel' => '0',
                    
                ];
                if($this->ebooksModel->save($bdata) === true){
                    $atdata = [
                        'atuid' => $uid,
                        'ataction' => 'Add',
                        'atmessage' => 'Add a new ebook ('.$bdata['ebtitle'].')',
                        'atdatetime' => date('Y-m-d H:i:s'),
                        
                    ];
                    $this->atModel->save($atdata);
                    session()->setTempdata('success','E-Book added successfully', 3);
                    return redirect()->to(current_url());
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('ebooksview', $data);
    }
    public function deleteEBook($id=null) {
        $data = [
            'ebisdel' => '1',
        ];

        if($this->ebooksModel->where('ebid', $id)->update($id, $data)){
            $uid = session()->get('logged_user');
            $getebook = $this->ebooksModel->where('ebid', $id)->findAll();
            foreach ($getebook as $ebookdata)
            {
                $ebooktitle = $ebookdata['ebtitle'];
            }
            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Delete',
                'atmessage' => 'Deleted a e-book ('.$ebooktitle.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('deletesuccess', 'E-Book deleted!', 2);
            return redirect()->to(base_url()."ebooks"); 
        }
        
    }
    public function ebookUpdate($id=null) {
        $data = [
            'page_title' => 'HCC Library System | E-Books',
            'page_heading' => 'E-Books',
        ];
        if($this->request->getMethod() == 'post') {
            $data = [
                'ebtitle' => $this->request->getVar('ebtitle'),
                'ebauthors' => $this->request->getVar('ebauthors'),
                'eblink' => $this->request->getVar('eblink'),
            ];

            if($this->ebooksModel->where('ebid', $id)->update($id, $data)) {
                $uid = session()->get('logged_user');
                $getebook = $this->ebooksModel->where('ebid', $id)->findAll();
                foreach ($getebook as $ebookdata)
                {
                    $ebooktitle = $ebookdata['ebtitle'];
                }
                $atdata = [
                    'atuid' => $uid,
                    'ataction' => 'Update',
                    'atmessage' => 'Updated a e-book ('.$ebooktitle.')',
                    'atdatetime' => date('Y-m-d H:i:s'),
                    
                ];
                $this->atModel->save($atdata);
                session()->setTempdata('deletesuccess', 'Update Successful!', 2);
                return redirect()->to(base_url()."ebooks"); 
            }         
        }
    }
}
