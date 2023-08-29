<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use App\Models\AuditTrailModel;
use \CodeIgniter\View\Table;
use App\Models\UsersModel;
class CategoryController extends BaseController
{
    public $catModel;
    public $atModel;
    public $usersModel;
    public function __construct() {
        helper('form');
        $this->atModel = new AuditTrailModel();
        $this->catModel = new CategoryModel();
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | Book Category',
            'page_heading' => 'BOOK CATEGORIES',
        ];
        if(!session()->has('logged_user'))
        {
            return redirect()->to(base_url()."admin");
        }
        $uid = session()->get('logged_user');
        $data['userdata'] = $this->catModel->getLoggedInUserData($uid);
        $data['usersaccess'] = $this->usersModel->where('uid', $uid)->findAll();
        $data['cat'] = $this->catModel->where('isdel', 0)->findAll();

        if($this->request->getMethod() == 'post') {
            $rules = [
                'name' => [
                    'rules' => 'required|is_unique[category.catname]',
                    'errors' => [
                        'required' => 'Category is required.',
                        'is_unique' => 'This category is already exists or check the archive.',
                    ],
                ],
            ];
            if($this->validate($rules))
            {
                $udata = [
                    'catname' => $this->request->getVar('name'),
                    'isdel' => '0',
                ];
                if($this->catModel->save($udata) === true){
                    $atdata = [
                        'atuid' => $uid,
                        'ataction' => 'Add',
                        'atmessage' => 'Add a new book category ('.$udata['catname'].')',
                        'atdatetime' => date('Y-m-d H:i:s'),
                        
                    ];
                    $this->atModel->save($atdata);
                    session()->setTempdata('success','Category added successfully', 3);
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
        return view('categoryview', $data);
    }
    public function deleteCategory($id=null) {
        $data = [
            'isdel' => '1',
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
                'ataction' => 'Delete',
                'atmessage' => 'Deleted a book category ('.$namecategory.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('deletesuccess', 'Category deleted!', 2);
            return redirect()->to(base_url()."categories"); 
        }
        
    }
    public function categoryUpdate($id=null) {
        if($this->request->getMethod() == 'post') {
            $data = [
                'catname' => $this->request->getVar('name'),
            ];

            if($this->catModel->where('catid', $id)->update($id, $data)) {
                $uid = session()->get('logged_user');
                $getnameofcategory = $this->catModel->where('catid', $id)->findAll();
                foreach ($getnameofcategory as $nameofcategory)
                {
                    $namecategory = $nameofcategory['catname'];
                }
                $atdata = [
                    'atuid' => $uid,
                    'ataction' => 'Update',
                    'atmessage' => 'Updated a book category ('.$namecategory.')',
                    'atdatetime' => date('Y-m-d H:i:s'),
                    
                ];
                $this->atModel->save($atdata);
                session()->setTempdata('deletesuccess', 'Update Successful!', 2);
                return redirect()->to(base_url()."categories"); 
            }
        }
        
    }
    
}
