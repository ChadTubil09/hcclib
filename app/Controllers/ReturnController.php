<?php

namespace App\Controllers;
use App\Models\BooksModel;
use App\Models\BorrowModel;
use App\Models\CategoryModel;
use App\Models\AuditTrailModel;
use App\Models\UsersModel;
use App\Models\AccessionModel;
class ReturnController extends BaseController
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
            'page_heading' => 'RETURN BOOKS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->booksModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();

        $bookCondition = array('isdel' => 0, 'status' => 0);
        $data['booklist'] = $this->booksModel->where($bookCondition)->findAll();
        $data['catlist'] = $this->catModel->where('isdel', 0)->findAll();
        $data['borrowlist'] = $this->borrowModel->where('status', '0')->findAll();
        $data['accessionlist'] = $this->accessionModel->where('isdel', '0')->findAll();

        return view('returnview', $data);
    }
    public function returnProcess($id=null) {
        $data = [
            'status' => '1',
            'returndate' => date('Y-m-d'),
        ];

        if($this->borrowModel->where('borrowid', $id)->update($id, $data)){
            $selectborrow = $this->borrowModel->where('borrowid', $id)->findAll();
            foreach ($selectborrow as $borrow)
            {
                $accid = $borrow['baccid'];
            }
            $selectacc = $this->accessionModel->where('accid', $accid)->findall();
            foreach ($selectacc as $acc)
            {
                $accbookid = $acc['accbookid'];
            }
            $updatecopy = $this->booksModel->set('copies', 'copies+1', false);
            $this->booksModel->where('bookid', $accbookid)->update($accbookid, $updatecopy);

            $updateaccession = $this->accessionModel->set('status', '0');
            $this->accessionModel->where('accid', $accid)->update($accid, $updateaccession);

            $uid = session()->get('logged_user');
            
            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Return',
                'atmessage' => 'The book returned to the library. TRN-('.$id.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('returnsuccess', 'The book returned to the library!', 2);
            return redirect()->to(base_url()."return"); 
        }
        
    }
}
