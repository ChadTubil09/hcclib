<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\PositionModel;
use App\Models\CategoryModel;
use App\Models\AuditTrailModel;
use App\Models\BooksModel;
use \CodeIgniter\View\Table;
use App\Models\AccessionModel;
class ArchiveController extends BaseController
{
    public $usersModel;
    public $posModel;
    public $catModel;
    public $atModel;
    public $booksModel;
    public $accessionModel;
    public function __construct() {
        helper('form');
        //$this->dModel = new DashboardModel();
        $this->usersModel = new UsersModel();
        $this->posModel = new PositionModel();
        $this->catModel = new CategoryModel();
        $this->atModel = new AuditTrailModel();
        $this->booksModel = new BooksModel();
        $this->accessionModel = new AccessionModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | Archive',
            'page_heading' => 'ARCHIVES',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();
        // USERS
        $data['userslist'] = $this->usersModel->where('isdel', 1)->findAll();
        $data['poslist'] = $this->posModel->where('posisdel', 0)->findAll();
        // POSITIONS
        $data['posdata'] = $this->posModel->where('posisdel',1)->findAll();
        // CATEGORIES
        $data['cat'] = $this->catModel->where('isdel', 1)->findAll();
        $data['catlist'] = $this->catModel->where('isdel', 0)->findAll();
        // BOOKS
        $data['booklist'] = $this->booksModel->where('isdel', 1)->findAll();

        return view('archiveview', $data);
    }
    public function archiveUser($id=null) {
        $data = [
            'isdel' => '0',
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
                'ataction' => 'Restore',
                'atmessage' => 'Restored a deleted user ('.$nameuser.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('usersdeletesuccess', 'Restored!', 2);
            return redirect()->to(base_url()."archives"); 
        }
        
    }
    public function archivePosition($id=null) {
        $data = [
            'posisdel' => '0',
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
                'ataction' => 'Restore',
                'atmessage' => 'Restored a position ('.$nameposition.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('positiondeletesuccess', 'Restored!', 2);
            return redirect()->to(base_url()."archives"); 
        }
        
    }
    public function archiveCategory($id=null) {
        $data = [
            'isdel' => '0',
        ];

        if($this->catModel->where('catid', $id)->update($id, $data)){
            $uid = session()->get('logged_user');
            $getnameofcategory = $this->catModel->where('catid', $id)->findAll();
            foreach ($getnameofcategory as $nameofcategory)
            {
                $namecategory = $nameofcategory['catname'];
            }
            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Restore',
                'atmessage' => 'Restored a book category ('.$namecategory.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('categorydeletesuccess', 'Restored!', 2);
            return redirect()->to(base_url()."archives"); 
        }
        
    }
    public function archiveBook($id=null) {
        $data = [
            'isdel' => '0',
        ];

        if($this->booksModel->where('bookid', $id)->update($id, $data)){
            $uid = session()->get('logged_user');
            $getnameofbook = $this->booksModel->where('bookid', $id)->findAll();
            foreach ($getnameofbook as $nameofbook)
            {
                $namebook = $nameofbook['title'];
            }
            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Restore',
                'atmessage' => 'Restored a deleted book ('.$namebook.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('bookdeletesuccess', 'Restored!', 2);
            return redirect()->to(base_url()."archives"); 
        }
        
    }
    public function brokenBooks(){
        $data = [
            'page_title' => 'HCC Library System | Broken/Lost Books',
            'page_heading' => 'BROKEN OR LOST BOOKS',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->usersModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();

        // ACCESSION
        $data['accessionlist'] = $this->accessionModel->where('isdel', 1)->findAll();
        $data['accbooklist'] = $this->booksModel->findAll();

        return view('brokenview', $data);
    }
    public function brokenBooksRestore($id=null)
    {
        $data = [
            'isdel' => '0',
        ];

        if($this->accessionModel->where('accid', $id)->update($id, $data)){
            $getaccbookid = $this->accessionModel->where('accid', $id)->findAll();
            foreach ($getaccbookid as $accdata)
            {
                $accessionbookid = $accdata['accbookid'];
                $accessionno = $accdata['accno'];
            }
            $updatecopy = $this->booksModel->set('copies', 'copies+1', false);
            $this->booksModel->where('bookid', $accessionbookid)->update($accessionbookid, $updatecopy);
            $uid = session()->get('logged_user');
            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Restore',
                'atmessage' => 'Restored a deleted copy of book with acc no.('.$accessionno.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('bookdeletesuccess', 'Restored!', 2);
            return redirect()->to(base_url()."broken"); 
        }
    }
}
