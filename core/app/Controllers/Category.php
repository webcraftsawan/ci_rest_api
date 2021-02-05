<?php
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Category extends BaseController
{
    
    public function __construct()
    {
        
        $this->security = \Config\Services::security();

        $this->validation =  \Config\Services::validation();

        $this->session = \Config\Services::session();

        // Set Model
        $this->common_model = new Auth_Model();

        helper(['form','common']);

        if (!$this->session->get('admin')) {
            return redirect()->to(base_url('admin'));
        }
    }

    // Listings
    public function index()
    {

        $data = [];
        $data['title'] = 'Category';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/category/store');
        $data['user'] = $this->session->get('admin');
        $data['categories'] = $this->common_model->get('categories');

        if ($this->session->get('admin')) {
            return view('admin/category/index', $data);
        } else {
            return redirect()->to(base_url('admin'));
        }
    }

    // Create Form Page
    public function create()
    {
        $data = [];
        $data['title'] = 'Create - Category';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/category/store');
        $data['user'] = $this->session->get('admin');
        $data['all_cats'] = $this->common_model->getResult('categories' , ['parent_id' => 0]);
        $data['resp'] = [];
        return view('admin/category/create', $data);
    }

    // Insert data in DB
    public function store()
    {
        $data = [];
        $data['title'] = 'Create - Category';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/category/store');
        $data['user'] = $this->session->get('admin');

        $rules = [
            'title' => [
                'label' => 'Title' ,
                'rules' => 'required|min_length[3]',
            ],
            'status'    => [
                'label' => 'Status' ,
                'rules' => 'required',
            ]
        ];

        // Validation Fields
        $val = $this->validate($rules);

        if (!$val) {
            $error_text = '';
            foreach ($this->validator->getErrors() as $keys => $error) {
                $data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
            }

            return view('admin/category/create', $data);
        } else {
            $postData = array(
                
                'title'         => $this->request->getPost('title'),
                
                'parent_id'     => $this->request->getPost('parent_id'),
                
                'status'        => $this->request->getPost('status'),
            
            );

            $resp = $this->common_model->add('categories', $postData);

            if ($resp) {
                $this->session->setFlashdata('success', 'Category created successfully');

                return redirect()->to(base_url('admin/category/list'));
            }
        }
    }

    // Edit Form Page
    public function edit($id)
    {
        $data = [];
        $data['title'] = 'Edit - Category';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/category/update/'.$id);
        $data['user'] = $this->session->get('admin');
        $data['resp'] = $this->common_model->get('categories', ['id' => $id]);
        $data['all_cats'] = $this->common_model->get('categories');
        return view('admin/category/edit', $data);
    }

    // Update data in DB
    public function update($id)
    {
        $data = [];
        $data['title'] = 'Update - Category';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/category/update/'.$id);
        $data['user'] = $this->session->get('admin');
        $data['all_cats'] = $this->common_model->get('categories');

        $data['resp'] = $this->common_model->get('categories', ['id' => $id]);
        
        $rules = [
            'title' => [
                'label' => 'Title' ,
                'rules' => 'required|min_length[6]',
            ],
            'status'    => [
                'label' => 'Status' ,
                'rules' => 'required',
            ]
        ];

        // Validation Fields
        $val = $this->validate($rules);

        if (!$val) {
            $error_text = '';
            foreach ($this->validator->getErrors() as $keys => $error) {
                $data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
            }

            return view('admin/category/create', $data);
        } else {
            $postData = array(
                
                'title' => $this->request->getPost('title'),
                
                'parent_id' => $this->request->getPost('parent_id'),
                
                'status' => $this->request->getPost('status'),
            
            );

            $resp = $this->common_model->edit('categories', [ 'id' => $id ], $postData);

            if ($resp) {
                $this->session->setFlashdata('success', 'Category updated successfully');

                return redirect()->to(base_url('admin/category/list'));
            }
        }
    }

    // Delete data
    public function delete($id)
    {

        $resp = $this->common_model->deleteData('categories', [ 'id' => $id ]);

        if ($resp) {
            $this->session->setFlashdata('success', 'Category deleted');

            return redirect()->to(base_url('admin/category/list'));
        }
    }

    // Fetch Subcategory based on Category
    public function getSubcategories($id)
    {
        $subcategories = $this->common_model->getCount('categories', ['parent_id' => $id]);
        if ($subcategories) {
            $dt = json_encode([ 'status' => true , 'subcategories' => $subcategories]);
        } else {
            $dt = json_encode([ 'status' => false , 'subcategories' => $subcategories]);
        }
        echo $dt;
        exit;
    }
}
