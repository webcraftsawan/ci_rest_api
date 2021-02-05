<?php
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Video extends BaseController
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
        $data['title'] = 'Video';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/videos/store');
        $data['user'] = $this->session->get('admin');
        $data['lists'] = $this->common_model->get('videos');

        if ($this->session->get('admin')) {
            return view('admin/videos/index', $data);
        } else {
            return redirect()->to(base_url('admin'));
        }
    }

    // Create Form Page
    public function create()
    {
 
        $data = [];
        $data['title'] = 'Add video details';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/videos/store');
        $data['user'] = $this->session->get('admin');
        $data['resp'] = [];

        return view('admin/videos/create', $data);
    }

    // Insert data in DB
    public function store()
    {
        $data = [];
        $data['title'] = 'Create - Video';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/videos/store');
        $data['user'] = $this->session->get('admin');

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

        $videoName = "";
        if ($file = $this->request->getFile('video')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $videoName = $file->getRandomName();
                $file->move(ROOTPATH.'public/videos', $videoName);
            }
        }

        $videoCoverImageName = "";
        if ($coverImage = $this->request->getFile('cover_image')) {
            if ($coverImage->isValid() && ! $coverImage->hasMoved()) {
                $videoCoverImageName = $coverImage->getRandomName();
                $coverImage->move(ROOTPATH.'public/videos/cover_image', $videoCoverImageName);
            }
        }

        // Validation Fields
        $val = $this->validate($rules);

        if (!$val) {
            $error_text = '';
            foreach ($this->validator->getErrors() as $keys => $error) {
                $data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
            }
            return view('admin/videos/create', $data);
        } else {
            $postData = array(
                
                'title'             => $this->request->getPost('title'),
                
                'description'       => $this->request->getPost('description'),

                'tags'              => $this->request->getPost('tags'),
                
                'featured_tags'     => $this->request->getPost('featured_tags'),
                
                'from_date_time'    => datetotimestamp($this->request->getPost('from_date_time')),
                
                'to_date_time'      => datetotimestamp($this->request->getPost('to_date_time')),

                'video_url'         => $this->request->getPost('video_url'),
                
                'video'             => $videoName,

                'cover_image'       => $videoCoverImageName
            
            );

            $resp = $this->common_model->add('videos', $postData);

            if ($resp) {
                $this->session->setFlashdata('success', 'Video created successfully');

                return redirect()->to(base_url('admin/videos/list'));
            }
        }
    }

    // Edit Form Page
    public function edit($id)
    {
        $data = [];
        $data['title'] = 'Edit - Video';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/videos/update/'.$id);
        $data['user'] = $this->session->get('admin');
        $data['resp'] = $this->common_model->get('videos', ['id' => $id]);
        return view('admin/videos/create', $data);
    }

    // Update data in DB
    public function update($id)
    {
        $data = [];
        $data['title'] = 'Update - Video';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/videos/update/'.$id);
        $data['user'] = $this->session->get('admin');

        $data['resp'] = $this->common_model->get('videos', ['id' => $id]);
        
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

        $videoName = $this->request->getPost('old_video');
        if ($file = $this->request->getFile('video')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $videoName = $file->getRandomName();
                $file->move(ROOTPATH.'public/videos', $videoName);
            }
        }

        $videoCoverImageName = $this->request->getPost('old_cover_image');
        if ($coverImage = $this->request->getFile('cover_image')) {
            if ($coverImage->isValid() && ! $coverImage->hasMoved()) {
                $videoCoverImageName = $coverImage->getRandomName();
                $coverImage->move(ROOTPATH.'public/videos/cover_image', $videoCoverImageName);
            }
        }

        // Validation Fields
        $val = $this->validate($rules);

        if (!$val) {
            $error_text = '';
            foreach ($this->validator->getErrors() as $keys => $error) {
                $data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
            }
            return view('admin/videos/create', $data);
        } else {
            $postData = array(
                
                'title'             => $this->request->getPost('title'),
                
                'description'       => $this->request->getPost('description'),

                'tags'              => $this->request->getPost('tags'),
                
                'featured_tags'     => $this->request->getPost('featured_tags'),
                
                'from_date_time'    => datetotimestamp($this->request->getPost('from_date_time')),
                
                'to_date_time'      => datetotimestamp($this->request->getPost('to_date_time')),

                'video_url'         => $this->request->getPost('video_url'),
                
                'video'             => $videoName,

                'cover_image'       => $videoCoverImageName
            
            );

            $resp = $this->common_model->edit('videos', [ 'id' => $id ], $postData);

            if ($resp) {
                $this->session->setFlashdata('success', 'Video updated successfully');

                return redirect()->to(base_url('admin/videos/list'));
            }
        }
    }

    // Delete data
    public function delete($id)
    {

        $resp = $this->common_model->deleteData('videos', [ 'id' => $id ]);

        if ($resp) {
            $this->session->setFlashdata('success', 'Video deleted');

            return redirect()->to(base_url('admin/videos/list'));
        }
    }
}
