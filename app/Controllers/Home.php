<?php

namespace App\Controllers;
use App\Models\BooksModel;
use App\Models\CategoryModel;
use App\Models\EBooksModel;
class Home extends BaseController
{
    public $booksModel;
    public $catModel;
    public $ebooksModel;
    public function __construct() {
        helper('form');
        
        $this->booksModel = new BooksModel();
        $this->catModel = new CategoryModel();
        $this->ebooksModel = new EBooksModel();
    }
    public function index()
    {
        $data = [
            'page_title' => 'HCC Library System | OPAC',
            'page_heading' => 'Users',
        ];
        $data['recentup'] = $this->booksModel->orderBy('bookid', 'desc')
                                            ->paginate(5);
        $data['pager'] = $this->booksModel->pager;
        $data['catlist'] = $this->catModel->where('isdel', 0)->findAll();
        $data['booklist'] = $this->booksModel->findall();
        return view('homeview', $data);
    }
    public function searchresult()
    {
        
        $data = [
            'page_title' => 'HCC Library System | OPAC',
            'page_heading' => 'Users',
        ];
        if($this->request->getMethod() == 'post') {
            $data['catlist'] = $this->catModel->where('isdel', 0)->findAll();
            $selectype = $this->request->getVar('book');
            if($selectype === 'books')
            {
                $data['booklist'] = $this->booksModel->findall();

                $search = $this->request->getVar('search');
                $getcategoryname = $this->catModel->like('catname', $search)->findAll();
                foreach($getcategoryname as $gcn){
                    $getcatid = $gcn['catid'];
                }
                if($search === ''){
                    return redirect()->to(base_url()."search");
                }
                else{
                    $data['results'] = $this->booksModel->like('title', $search)
                                                    ->orLike('authors', $search)
                                                    ->orLike('isbn', $search)
                                                    ->orLike('issn', $search)
                                                    ->orLike('publication', $search)
                                                    ->orLike('placeofpub', $search)
                                                    ->orLike('dateofpub', $search)
                                                    ->orLike('bookcatid', $getcatid)
                                                    ->findAll();
                    return view('homeresultview', $data);
                }
            }
            else
            {
                $search = $this->request->getVar('search');
                $data['results'] = $this->ebooksModel->like('ebtitle', $search)
                                                    ->orLike('ebauthors', $search)
                                                    ->findAll();
                
                return view('homeresultview2', $data);
            }
        }
        return view('homeresultview', $data);
        
    }
}
