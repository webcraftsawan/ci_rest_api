<?php
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class image extends BaseController
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
        $data['title'] = 'Image album Listing';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/images/store');
        $data['user'] = $this->session->get('admin');
        $data['lists'] = $this->common_model->get('images');
        $data['categories'] = $this->common_model->get('categories');

        if ($this->session->get('admin')) {
            return view('admin/image/index', $data);
        } else {
            return redirect()->to(base_url('admin'));
        }
    }

    // Create Form Page
    public function create()
    {
 
        $data = [];
        $data['title'] = 'Add Image album details';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/images/store');
        $data['user'] = $this->session->get('admin');
        $data['categories'] = $this->common_model->get('categories');
        $data['resp'] = [];
        if ($this->session->get('admin')) {
            return view('admin/image/create', $data);
        } else {
            return redirect()->to(base_url('admin'));
        }
    }

    // Insert data in DB
    public function store()
    {
        $data = [];
        $data['title'] = 'Create - Image album';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/images/store');
        $data['user'] = $this->session->get('admin');
        $data['categories'] = $this->common_model->get('categories');
        $data['sub_categories'] = [];
        $rules = [
            'title' => [
                'label' => 'Title',
                'rules' => 'required|min_length[6]',
            ],
            'description'   => [
                'label' => 'Description',
                'rules' => 'required|min_length[250]',
            ],
            'category_id' => [
                'label' => 'Category',
                'rules' => 'required'
            ],
           /* 'subcategory_id' => [
                'label' => 'Subcategory',
                'rules' => 'required'
            ],*/
            'tags'  => [
                'label' => 'Tags',
                'rules' => 'required',
            ],
            'featured_tags' => [
                'label' => 'Featured Tags',
                'rules' => 'required',
            ],
            'from_date_time'    => [
                'label' => 'From Date',
                'rules' => 'required',
            ],
            'to_date_time'  => [
                'label' => 'To Date',
                'rules' => 'required',
            ]
        ];

       
        $start_date = strtotime($this->request->getPost('from_date_time'));
        $end_date = strtotime($this->request->getPost('to_date_time'));

        if ($start_date > $end_date) {
            $rules += array('resp_date' => [ 'label' => 'From Date' , 'rules' =>'valid_date' , 'errors' => [ 'valid_date' => 'End Date must be greater than Start Date' ] ] );
        }

        $imageName = "";
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move(ROOTPATH.'public/images', $imageName);
            }
        }

        $imageCoverImageName = "";
        if ($coverImage = $this->request->getFile('cover_image')) {
            if ($coverImage->isValid() && ! $coverImage->hasMoved()) {
                $imageCoverImageName = $coverImage->getRandomName();
                $coverImage->move(ROOTPATH.'public/images/cover_image', $imageCoverImageName);
            }
        }

        // Validation Fields
        $val = $this->validate($rules);

        if (!$val) {
            $error_text = '';
            foreach ($this->validator->getErrors() as $keys => $error) {
                $data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
            }
            return view('admin/image/create', $data);
        } else {
            $postData = array(
                
                'title'             => $this->request->getPost('title'),
                
                'description'       => $this->request->getPost('description'),

                'tags'              => $this->request->getPost('tags'),
                
                'featured_tags'     => $this->request->getPost('featured_tags'),
                
                'category_id'       => $this->request->getPost('category_id'),

                //'subcategory_id'    => $this->request->getPost('subcategory_id'),
                
                'from_date_time'    => datetotimestamp($this->request->getPost('from_date_time')),
                
                'to_date_time'      => datetotimestamp($this->request->getPost('to_date_time')),

                'image'             => $imageName,

                'cover_image'       => $imageCoverImageName
            
            );

            $resp = $this->common_model->add('images', $postData);

            if ($resp) {
                $this->session->setFlashdata('success', 'Image Album Created Successfully');

                return redirect()->to(base_url('admin/images/list'));
            }
        }
    }

    // Edit Form Page
    public function edit($id)
    {
        $data = [];
        $data['title'] = 'Edit - image album';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/images/update/'.$id);
        $data['user'] = $this->session->get('admin');
        $data['resp'] = $this->common_model->get('images', ['id' => $id]);
        $data['categories'] = $this->common_model->get('categories');
        return view('admin/image/create', $data);
    }

    // Update data in DB
    public function update($id)
    {
        $data = [];
        $data['title'] = 'Update - image album';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/images/update/'.$id);
        $data['user'] = $this->session->get('admin');
        $data['resp'] = $this->common_model->get('images', ['id' => $id]);
        
        $rules = [
            'title' => [
                'label' => 'Title',
                'rules' => 'required|min_length[6]',
            ],
            'description'   => [
                'label' => 'Description',
                'rules' => 'required|min_length[250]',
            ],
            'tags'  => [
                'label' => 'Tags',
                'rules' => 'required',
            ],
            'featured_tags' => [
                'label' => 'Featured Tags',
                'rules' => 'required',
            ],
            'from_date_time'    => [
                'label' => 'From Date',
                'rules' => 'required',
            ],
            'to_date_time'  => [
                'label' => 'To Date',
                'rules' => 'required',
            ]
        ];

        $start_date = strtotime($this->request->getPost('from_date_time'));
        $end_date = strtotime($this->request->getPost('to_date_time'));

        if ($start_date > $end_date) {
            $rules += array('resp_date' => [ 'label' => 'From Date' , 'rules' =>'valid_date' , 'errors' => [ 'valid_date' => 'End Date must be greater than Start Date' ] ] );
        }

        $imageName = $this->request->getPost('old_image');
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move(ROOTPATH.'public/images', $imageName);
            }
        }

        $imageCoverImageName = $this->request->getPost('old_cover_image');
        if ($coverImage = $this->request->getFile('cover_image')) {
            if ($coverImage->isValid() && ! $coverImage->hasMoved()) {
                $imageCoverImageName = $coverImage->getRandomName();
                $coverImage->move(ROOTPATH.'public/images/cover_image', $imageCoverImageName);
            }
        }

        // Validation Fields
        $val = $this->validate($rules);

        if (!$val) {
            $error_text = '';
            foreach ($this->validator->getErrors() as $keys => $error) {
                $data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
            }
            return view('admin/image/create', $data);
        } else {
            $postData = array(
                
                'title'             => $this->request->getPost('title'),
                
                'description'       => $this->request->getPost('description'),

                'tags'              => $this->request->getPost('tags'),
                
                'featured_tags'     => $this->request->getPost('featured_tags'),
                
                'from_date_time'    => datetotimestamp($this->request->getPost('from_date_time')),
                
                'to_date_time'      => datetotimestamp($this->request->getPost('to_date_time')),

                'video_url'         => $this->request->getPost('video_url'),
                
                'image'             => $imageName,

                'cover_image'       => $imageCoverImageName
            
            );

            $resp = $this->common_model->edit('images', [ 'id' => $id ], $postData);

            if ($resp) {
                $this->session->setFlashdata('success', 'Image Album updated successfully');

                return redirect()->to(base_url('admin/image/list'));
            }
        }
    }

    // Delete data
    public function delete($id)
    {

        $resp = $this->common_model->deleteData('images', [ 'id' => $id ]);

        if ($resp) {
            $this->session->setFlashdata('success', 'Image Album deleted');

            return redirect()->to(base_url('admin/images/list'));
        }
    }
}
