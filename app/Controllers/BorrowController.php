<?php

namespace App\Controllers;
use App\Models\BooksModel;
use App\Models\BorrowModel;
use App\Models\CategoryModel;
use App\Models\AuditTrailModel;
use App\Models\UsersModel;
use App\Models\AccessionModel;
class BorrowController extends BaseController
{
    public $booksModel;
    public $catModel;
    public $borrowModel;
    public $atModel;
    public $usersModel;
    public $accessionModel;
    public function __construct() {
        helper('form');
        $this->booksModel = new BooksModel();
        $this->catModel = new CategoryModel();
        $this->borrowModel = new BorrowModel();
        $this->atModel = new AuditTrailModel();
        $this->usersModel = new UsersModel();
        $this->accessionModel = new AccessionModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | Books',
            'page_heading' => 'BORROW BOOKS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->booksModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();

        $bookCondition = array('isdel' => 0, 'status' => 0, 'copies !=' => 0);
        $data['booklist'] = $this->booksModel->where($bookCondition)->findAll();
        $data['catlist'] = $this->catModel->where('isdel', 0)->findAll();

        return view('borrowview', $data);
    }

    public function borrowProcess($id=null) {
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

        $date = [];
        $getaccdata = $this->accessionModel->where('accid', $id)->findAll();
            foreach ($getaccdata as $accdata)
            {
                $accessionbookid = $accdata['accbookid'];
                $accessionno = $accdata['accno'];
            }
        if($this->request->getMethod() == 'post') {
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name of borrower is required.'
                    ],
                ],
                'studentno' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Student of Employee number is required.'
                    ],
                ],
                'duedateofreturn' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Due Date of Return is required.'
                    ],
                ],
            ];
            if($this->validate($rules))
            {
                $borrowdata = [
                    'baccid' => $id,
                    'name' => $this->request->getVar('name'),
                    'studentno' => $this->request->getVar('studentno'),
                    'grade' => $this->request->getVar('txtgrade'),
                    'section' => $this->request->getVar('txtsection'),
                    'duedateofreturn' => $this->request->getVar('duedateofreturn'),
                    'contactno' => $this->request->getVar('contactno'),
                    'borrowdate' => date('Y-m-d'),
                    'status' => '0',
                ];
                if($this->borrowModel->save($borrowdata) === true)
                {
                    $updatecopy = $this->booksModel->set('copies', 'copies-1', false);
                    $this->booksModel->where('bookid', $accessionbookid)->update($accessionbookid, $updatecopy);
                    $updateaccstatus = $this->accessionModel->set('status', '1');
                    $this->accessionModel->where('accid', $id)->update($id, $updateaccstatus);
                    $uid = session()->get('logged_user');
                    $atdata = [
                        'atuid' => $uid,
                        'ataction' => 'Borrow',
                        'atmessage' => 'Borrow process with book accession no. of ('.$accessionno.')',
                        'atdatetime' => date('Y-m-d H:i:s'),
                        
                    ];
                    $this->atModel->save($atdata);
                    session()->setTempdata('successborrow','The book transaction is successful.', 3);
                    return redirect()->to(base_url()."borrow");
                }
            }
            else
            {
                // $data['validation'] = $this->validator;
                // session()->setTempdata('errorborrow','Cant process this transaction. Please fill up all the fields.', 3);
                // return redirect()->to(base_url()."borrow");
                $data['validation'] = $this->validator;
            }
        }
        return view('accessionborrowsetview', $data);
    }
    
}
