<?php

namespace App\Controllers;
use App\Models\BooksModel;
use App\Models\AuditTrailModel;
use App\Models\CategoryModel;
use App\Models\UsersModel;
use App\Models\AccessionModel;
class AccessionController extends BaseController
{
    public $booksModel;
    public $atModel;
    public $catModel;
    public $usersModel;
    public $accessionModel;
    public function __construct() {
        helper('form');
        $this->booksModel = new BooksModel();
        $this->atModel = new AuditTrailModel();
        $this->catModel = new CategoryModel();
        $this->usersModel = new UsersModel();
        $this->accessionModel = new AccessionModel();
    }
    public function index($id)
    {
        $data = [
            'page_title' => 'HCC Library System | Books',
            'page_heading' => 'BOOKS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->booksModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();
        
        $data['booklist'] = $this->booksModel->where('bookid', $id)->findAll();

        $accessionCondition = array('isdel' => 0, 'accbookid' => $id);
        $data['accessionlist'] = $this->accessionModel->where($accessionCondition)->findAll();

        return view('accessionview', $data);
    }
    public function addAccession($id){
        if($this->request->getMethod() == 'post'){
            $rules = [
                'accno' => [
                    'rules' => 'required|is_unique[accession.accno]',
                    'errors' => [
                        'required' => 'Book Accession Number is required.',
                        'is_unique' => 'Accession Number is already exists.',
                    ],
                ],
                'accno' => [
                    'rules' => 'required|is_unique[accession.accno]',
                    'errors' => [
                        'required' => 'Username is required.',
                        'is_unique' => 'This book acc no. is already exists.',
                    ],
                ],
            ];
            if($this->validate($rules)){
                $accessiondata = [
                    'accno' => $this->request->getVar('accno'),
                    'accbookid' => $id,
                    'status' => '0',
                    'isdel' => '0',
                ];
                if($this->accessionModel->save($accessiondata) === true){
                    $updatecopy = $this->booksModel->set('copies', 'copies+1', false);
                    $this->booksModel->where('bookid', $id)->update($id, $updatecopy);
                    $uid = session()->get('logged_user');
                    $atdata = [
                        'atuid' => $uid,
                        'ataction' => 'Add',
                        'atmessage' => 'Add a copy of book with accession no. of('.$accessiondata['accno'].')',
                        'atdatetime' => date('Y-m-d H:i:s'),
                        
                    ];
                    $this->atModel->save($atdata);
                    session()->setTempdata('success','Book added successfully', 3);
                    return redirect()->to(base_url()."books/view/".$id);
                }
            }
            else
            {
                $data['validation'] = $this->validator;
                session()->setTempdata('erroraddaccession','Book Accession Number is required or already exists.', 3);
                return redirect()->to(base_url()."books/view/".$id);
            }
        }
    }
    public function borrowView($id){
        $data = [
            'page_title' => 'HCC Library System | Books',
            'page_heading' => 'Books',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->booksModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();
        
        $data['booklist'] = $this->booksModel->where('bookid', $id)->findAll();

        $accessionCondition = array('isdel' => 0, 'accbookid' => $id);
        $data['accessionlist'] = $this->accessionModel->where($accessionCondition)->findAll();

        return view('accessionborrowview', $data);
    }
    public function borrowViewSet($id){
        $data = [
            'page_title' => 'HCC Library System | Books',
            'page_heading' => 'Books',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->booksModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();
        
        $getabd = $this->accessionModel->where('accid', $id)->findAll();
        foreach($getabd as $abd){
            $setacbookid = $abd['accbookid'];
            $setacid = $abd['accid'];
        }
        $data['booklist'] = $this->booksModel->where('bookid', $setacbookid)->findAll();

        $accessionCondition = array('isdel' => 0, 'accid' => $setacid);
        $data['accessionlist'] = $this->accessionModel->where($accessionCondition)->findAll();

        return view('accessionborrowsetview', $data);
    }

    public function deleteAccession($id=null) {
        $data = [
            'isdel' => '1',
        ];

        if($this->accessionModel->where('accid', $id)->update($id, $data)){
            $getaccbookid = $this->accessionModel->where('accid', $id)->findAll();
            foreach ($getaccbookid as $accdata)
            {
                $accessionbookid = $accdata['accbookid'];
                $accessionno = $accdata['accno'];
            }
            $updatecopy = $this->booksModel->set('copies', 'copies-1', false);
            $this->booksModel->where('bookid', $accessionbookid)->update($accessionbookid, $updatecopy);
            $uid = session()->get('logged_user');

            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Delete',
                'atmessage' => 'Deleted a copy of book with acc no. ('.$accessionno.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('deletesuccess', 'Copy deleted!', 2);
            return redirect()->to(base_url()."books/view/".$accessionbookid);
        }
        
    }
}
