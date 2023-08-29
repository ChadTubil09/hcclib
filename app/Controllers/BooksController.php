<?php

namespace App\Controllers;
use App\Models\BooksModel;
use App\Models\AuditTrailModel;
use App\Models\CategoryModel;
use App\Models\UsersModel;
class BooksController extends BaseController
{
    public $booksModel;
    public $atModel;
    public $catModel;
    public $usersModel;
    public function __construct() {
        helper('form');
        $this->booksModel = new BooksModel();
        $this->atModel = new AuditTrailModel();
        $this->catModel = new CategoryModel();
        $this->usersModel = new UsersModel();
    }
    public function index()
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

        $bookCondition = array('isdel' => 0, 'status' => 0);
        $data['booklist'] = $this->booksModel->where($bookCondition)->findAll();
        $data['catlist'] = $this->catModel->where('isdel', 0)->findAll();

        if($this->request->getMethod() == 'post') {
            $rules = [
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Book Title is required.'
                    ],
                ],
                'authors' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Book Author/s is required.'
                    ],
                ],
                'isbn' => [
                    'rules' => 'required|is_unique[books.isbn]',
                    'errors' => [
                        'required' => 'Book ISBN is required.'
                    ],
                ],
                // 'issn' => [
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'Book ISSN is required.'
                //     ],
                // ],
                'callnum' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Book Call Number is required.'
                    ],
                ],
                // 'dateofpub' => [
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'Book date publication is required.'
                //     ],
                // ],
                'selbook' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Book category is required.'
                    ],
                ],
                // 'copies' => [
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'Number of book copies is required.'
                //     ],
                // ],
            ];
            if($this->validate($rules))
            {
                $bdata = [
                    'title' => $this->request->getVar('title'),
                    'authors' => $this->request->getVar('authors'),
                    'edition' => $this->request->getVar('edition'),
                    'publication' => $this->request->getVar('publication'),
                    'placeofpub' => $this->request->getVar('placeofpub'),
                    'dateofpub' => $this->request->getVar('dateofpub'),
                    'bookcatid' => $this->request->getVar('selbook'),
                    'description' => $this->request->getVar('description'),
                    'subaddedentry' => $this->request->getVar('subaddedentry'),
                    'notes' => $this->request->getVar('notes'),
                    'contents' => $this->request->getVar('contents'),
                    'status' => '0',
                    'isdel' => '0',
                    'isbn' => $this->request->getVar('isbn'),
                    'issn' => $this->request->getVar('issn'),
                    'callnumber' => $this->request->getVar('callnum'),
                ];
                if($this->booksModel->save($bdata) === true){
                    $atdata = [
                        'atuid' => $uid,
                        'ataction' => 'Add',
                        'atmessage' => 'Add a new book ('.$bdata['title'].')',
                        'atdatetime' => date('Y-m-d H:i:s'),
                        
                    ];
                    $this->atModel->save($atdata);
                    session()->setTempdata('success','Book added successfully', 3);
                    return redirect()->to(current_url());
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('booksview', $data);
    }
    public function deleteBook($id=null) {
        $data = [
            'isdel' => '1',
        ];

        if($this->booksModel->where('bookid', $id)->update($id, $data)){
            $uid = session()->get('logged_user');
            $getbook = $this->booksModel->where('bookid', $id)->findAll();
            foreach ($getbook as $bookdata)
            {
                $booktitle = $bookdata['title'];
            }
            $atdata = [
                'atuid' => $uid,
                'ataction' => 'Delete',
                'atmessage' => 'Deleted a book ('.$booktitle.')',
                'atdatetime' => date('Y-m-d H:i:s'),
                
            ];
            $this->atModel->save($atdata);
            session()->setTempdata('deletesuccess', 'Book deleted!', 2);
            return redirect()->to(base_url()."books"); 
        }
        
    }
    public function bookUpdate($id=null) {
        $data = [
            'page_title' => 'HCC Library System | Books',
            'page_heading' => 'Books',
        ];
        if($this->request->getMethod() == 'post') {
            $rules = [
                'bookcover' => 'max_size[bookcover,1024]|ext_in[bookcover,png,jpg]',
            ];
            if($this->validate($rules))
            {
                $file = $this->request->getFile('bookcover');
                if($file->isValid() && !$file->hasMoved())
                {
                    if($file->move(FCPATH.'public\uploaded', $file->getRandomName()))
                    {
                        $imagepath = base_url().'public/uploaded/'.$file->getName();
                        $data = [
                            'title' => $this->request->getVar('title'),
                            'authors' => $this->request->getVar('authors'),
                            'edition' => $this->request->getVar('edition'),
                            'publication' => $this->request->getVar('publication'),
                            'placeofpub' => $this->request->getVar('placeofpub'),
                            'dateofpub' => $this->request->getVar('dateofpub'),
                            'bookcatid' => $this->request->getVar('selbook'),
                            //'copies' => $this->request->getVar('copies'),
                            'description' => $this->request->getVar('description'),
                            'subaddedentry' => $this->request->getVar('subaddedentry'),
                            'notes' => $this->request->getVar('notes'),
                            'contents' => $this->request->getVar('contents'),
                            'image' => $imagepath,
                            'isbn' => $this->request->getVar('isbn'),
                            'issn' => $this->request->getVar('issn'),
                            'callnumber' => $this->request->getVar('callnum'),
                        ];
            
                        if($this->booksModel->where('bookid', $id)->update($id, $data)) {
                            $uid = session()->get('logged_user');
                            $getbook = $this->booksModel->where('bookid', $id)->findAll();
                            foreach ($getbook as $bookdata)
                            {
                                $booktitle = $bookdata['title'];
                            }
                            $atdata = [
                                'atuid' => $uid,
                                'ataction' => 'Update',
                                'atmessage' => 'Updated a book ('.$booktitle.')',
                                'atdatetime' => date('Y-m-d H:i:s'),
                                
                            ];
                            $this->atModel->save($atdata);
                            session()->setTempdata('deletesuccess', 'Update Successful!', 2);
                            return redirect()->to(base_url()."books"); 
                        }
                    }
                }
                else
                {
                    $data = [
                        'title' => $this->request->getVar('title'),
                        'authors' => $this->request->getVar('authors'),
                        'edition' => $this->request->getVar('edition'),
                        'publication' => $this->request->getVar('publication'),
                        'placeofpub' => $this->request->getVar('placeofpub'),
                        'dateofpub' => $this->request->getVar('dateofpub'),
                        'bookcatid' => $this->request->getVar('selbook'),
                        //'copies' => $this->request->getVar('copies'),
                        'description' => $this->request->getVar('description'),
                        'subaddedentry' => $this->request->getVar('subaddedentry'),
                        'notes' => $this->request->getVar('notes'),
                        'contents' => $this->request->getVar('contents'),
                        'isbn' => $this->request->getVar('isbn'),
                        'issn' => $this->request->getVar('issn'),
                        'callnumber' => $this->request->getVar('callnum'),
                    ];
        
                    if($this->booksModel->where('bookid', $id)->update($id, $data)) {
                        $uid = session()->get('logged_user');
                        $getbook = $this->booksModel->where('bookid', $id)->findAll();
                        foreach ($getbook as $bookdata)
                        {
                            $booktitle = $bookdata['title'];
                        }
                        $atdata = [
                            'atuid' => $uid,
                            'ataction' => 'Update',
                            'atmessage' => 'Updated a book ('.$booktitle.')',
                            'atdatetime' => date('Y-m-d H:i:s'),
                            
                        ];
                        $this->atModel->save($atdata);
                        session()->setTempdata('deletesuccess', 'Update Successful!', 2);
                        return redirect()->to(base_url()."books"); 
                    } 
                }
            }
            else
            {
                $data['validation'] = $this->validator;
                session()->setTempdata('imageerror', 'There is a problem with uploading your book cover! Check the size
                of the image and the image type. JPG & PNG types are only acceptable.', 2);
                return redirect()->to(base_url()."books"); 
            }
                // ---------------------------------------------------------------------------

                // $file = $this->request->getFile('bookcover');
                // $file->move(FCPATH.'public\uploaded', $file->getRandomName());
                // $imagepath = base_url().'public/uploaded/'.$file->getName();

                // $data = [
                //     'title' => $this->request->getVar('title'),
                //     'authors' => $this->request->getVar('authors'),
                //     'edition' => $this->request->getVar('edition'),
                //     'publication' => $this->request->getVar('publication'),
                //     'placeofpub' => $this->request->getVar('placeofpub'),
                //     'dateofpub' => $this->request->getVar('dateofpub'),
                //     'bookcatid' => $this->request->getVar('selbook'),
                //     'copies' => $this->request->getVar('copies'),
                //     'description' => $this->request->getVar('description'),
                //     'subaddedentry' => $this->request->getVar('subaddedentry'),
                //     'notes' => $this->request->getVar('notes'),
                //     'contents' => $this->request->getVar('contents'),
                //     'image' => $imagepath,
                // ];
                
                // if($this->booksModel->where('bookid', $id)->update($id, $data)) {
                //     $uid = session()->get('logged_user');
                //     $getbook = $this->booksModel->where('bookid', $id)->findAll();
                //     foreach ($getbook as $bookdata)
                //     {
                //         $booktitle = $bookdata['title'];
                //     }
                //     $atdata = [
                //         'atuid' => $uid,
                //         'ataction' => 'Update',
                //         'atmessage' => 'Updated a book ('.$booktitle.')',
                //         'atdatetime' => date('Y-m-d H:i:s'),
                        
                //     ];
                //     $this->atModel->save($atdata);
                //     session()->setTempdata('deletesuccess', 'Update Successful!', 2);
                //     return redirect()->to(base_url()."books"); 
                // }
            
        }
    }
}
