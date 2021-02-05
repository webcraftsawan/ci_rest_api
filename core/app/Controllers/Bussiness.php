<?php
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Bussiness extends BaseController
{
    
    public function __construct()
    {
        
        $this->security = \Config\Services::security();

        $this->validation =  \Config\Services::validation();

        $this->session = \Config\Services::session();

        // Set Model
        $this->common_model = new Auth_Model();

        helper(['form','common']);
        $user = $this->session->get('admin');
        if (empty($user)) {
            return redirect()->to(base_url('admin'));
        }
    }

    // Listings
    public function index()
    {
        $data = [];
        $data['title'] = 'View Business listing';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/business/store');
        $data['user'] = $this->session->get('admin');
        $data['bussiness'] = $this->common_model->get('bussiness_listing');
        $data['categories'] = $this->common_model->get('categories');
        if ($this->session->get('admin')) {
            return view('admin/bussiness/index', $data);
        } else {
            return redirect()->to(base_url('admin'));
        }
    }

    // Create Form Page
    public function create()
    {
        $data = [];
        $data['title'] = 'Create - Business Listing';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/business/store');
        $data['user'] = $this->session->get('admin');

        $data['categories'] = $this->common_model->get('categories');
        $data['sub_categories'] = [];

        $data['resp'] = [];
        return view('admin/bussiness/create', $data);
    }

    // Insert data in DB
    public function store()
    {
        $data = [];
        $coverImage = "no-image.png";
        $albumImages = "no-image.png";
        $albumCover = "no-image.png";
        $data['title'] = 'Create - Tags';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/business/store');
        $data['user'] = $this->session->get('admin');
        $data['categories'] = $this->common_model->get('categories');
        $data['sub_categories'] = [];

        if ($file = $this->request->getFile('cover_image')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $coverImage = $file->getRandomName();
                $file->move(ROOTPATH.'public/bussiness', $coverImage);
            }
        }
        
        if ($file = $this->request->getFile('album_cover')) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $albumCover = $file->getRandomName();
                $file->move(ROOTPATH.'public/bussiness', $albumCover);
            }
        }

        if ($this->request->getFileMultiple('album_images')) {
            $dt = [];
            foreach ($this->request->getFileMultiple('album_images') as $fileN) {
                $fileName = $fileN->getRandomName();
                $fileN->move(ROOTPATH.'public/bussiness', $fileName);
                $dt[] = [
                    'name' =>  $fileName,
                    'type'  => $fileN->getClientMimeType()
                ];
            }
            $albumImages = json_encode($dt);
        }

        $rules = [
            'title' => [
                'label' => 'Title' ,
                'rules' => 'required|min_length[3]'
             ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required'
            ],
            'primary_contact' => [
                'label' => 'Primary Contact',
                'rules' => 'required'
            ],
            'secondary_contact' => [
                'label' => 'Secondary Contact',
                'rules' => 'required'
            ],
            'start_time' => [
                'label' => 'Start Time',
                'rules' => 'required'
            ],
            'end_time' => [
                'label' => 'End Time',
                'rules' => 'required'
            ],
            'address' => [
                'label' => 'Address',
                'rules' => 'required'
            ],
            'facebook_profile' => [
                'label' => 'Facebook',
                'rules' => 'required'
            ],
            'twitter_profile' => [
                'label' => 'Twitter',
                'rules' => 'required'
            ],
            'instagram_profile' => [
                'label' => 'Instagram',
                'rules' => 'required'
            ],
            'youtube_profile' => [
                'label' => 'Youtube',
                'rules' => 'required'
            ],
            'category_id' => [
                'label' => 'Category',
                'rules' => 'required'
            ],
           /* 'subcategory_id' => [
                'label' => 'Subcategory',
                'rules' => 'required'
            ],*/
            'tags' => [
                'label' => 'Tags',
                'rules' => 'required'
            ],
            'featured_tags' => [
                'label' => 'Featured tags',
                'rules' => 'required'
            ],
            'location_tags' => [
                'label' => 'Location tags',
                'rules' => 'required'
            ],
            'from_date_time' => [
                'label' => 'From Date Time',
                'rules' => 'required'
            ],
            'to_date_time' => [
                'label' => 'To Date Time',
                'rules' => 'required'
            ]
        ];

        $start_date = strtotime($this->request->getPost('from_date_time'));
        $end_date   = strtotime($this->request->getPost('to_date_time'));
        if ($start_date > $end_date) {
            $rules += array('datetime_error' => [ 'label' => 'From Date' , 'rules' =>'valid_date' , 'errors' => [ 'valid_date' => 'End Date must be greater than Start Date' ] ] );
        }

        $start_time = strtotime($this->request->getPost('start_time'));
        $end_time   = strtotime($this->request->getPost('end_time'));
        if ($start_time > $end_time) {
            $rules += array('time_error' => [ 'label' => 'From Time' , 'rules' =>'valid_date' , 'errors' => [ 'valid_date' => 'End Time must be greater than Start Time' ] ] );
        }

        // Validation Fields
        $val = $this->validate($rules);
        if (!$val) {
            $error_text = '';
            foreach ($this->validator->getErrors() as $keys => $error) {
                $data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
            }
            
            return view('admin/bussiness/create', $data);
        } else {
            $postData = array(
                'title'                 => $this->request->getPost('title'),
                'description'           => $this->request->getPost('description'),
                'primary_contact'       => $this->request->getPost('primary_contact'),
                'secondary_contact'     => $this->request->getPost('secondary_contact'),
                'start_time'            => date('H:i:s', strtotime($this->request->getPost('start_time'))),
                'end_time'              => date('H:i:s', strtotime($this->request->getPost('end_time'))),
                'address'               => $this->request->getPost('address'),
                'facebook'              => $this->request->getPost('facebook_profile'),
                'twitter'               => $this->request->getPost('twitter_profile'),
                'instagram'             => $this->request->getPost('instagram_profile'),
                'youtube'               => $this->request->getPost('youtube_profile'),
                'category_id'           => $this->request->getPost('category_id'),
                //'subcategory_id'        => $this->request->getPost('subcategory_id'),
                'tags'                  => $this->request->getPost('tags'),
                'featured_tags'         => $this->request->getPost('featured_tags'),
                'location_tags'         => $this->request->getPost('location_tags'),
                'from_date_time'        => datetotimestamp($this->request->getPost('from_date_time')),
                'to_date_time'          => datetotimestamp($this->request->getPost('to_date_time')),
                'banner_image'          => $coverImage,
                'cover_image'           => $albumCover,
                'album_images'          => $albumImages,
            );

            $resp = $this->common_model->add('bussiness_listing', $postData);

            if ($resp) {
                $this->session->setFlashdata('success', 'Business created successfully');

                return redirect()->to(base_url('admin/business'));
            }
        }
    }

    // Edit Form Page
    public function edit($id)
    {
        $data = [];
        $data['title'] = 'Edit - Bussiness listing';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/business/update/'.$id);
        $data['user'] = $this->session->get('admin');
        $data['resp'] = $this->common_model->get('bussiness_listing', ['id' => $id]);
        $data['categories'] = $this->common_model->get('categories');
        return view('admin/bussiness/create', $data);
    }

    // Update data in DB
    public function update($id)
    {
        $data = [];
        $data['title'] = 'Update - Tags';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/tags/update/'.$id);
        $data['user'] = $this->session->get('admin');
        $data['all_cats'] = $this->common_model->get('tags');

        $data['resp'] = $this->common_model->get('tags', ['id' => $id]);
        
        $rules = [
            'title' => [
                'label' => 'Title' ,
                'rules' => 'required|min_length[3]',
            ]
        ];

        // Validation Fields
        $val = $this->validate($rules);

        if (!$val) {
            $error_text = '';
            foreach ($this->validator->getErrors() as $keys => $error) {
                $data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
            }

            return view('admin/tags/create', $data);
        } else {
            $postData = array(
                
                'name' => $this->request->getPost('title'),
            
            );

            $resp = $this->common_model->edit('tags', [ 'id' => $id ], $postData);

            if ($resp) {
                $this->session->setFlashdata('success', 'Tag updated successfully');

                return redirect()->to(base_url('admin/tags/list'));
            }
        }
    }


    // View Form Page
    public function view($id)
    {
        $data = [];
        $data['title'] = 'View - Customer';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['form_action'] = base_url('admin/customers/update/'.$id);
        $data['user'] = $this->session->get('admin');
        $data['resp'] = $this->common_model->get('users', ['id' => $id]);
        return view('admin/customers/view', $data);
    }

    // Delete data
    public function delete($id)
    {
        $resp = $this->common_model->deleteData('bussiness_listing', [ 'id' => $id ]);

        if ($resp) {
            $this->session->setFlashdata('success', 'Bussiness Listing deleted');

            return redirect()->to(base_url('admin/business'));
        }
    }

    // Update Status
    public function updateStatus($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        
        $postData = array('status' => $status,);
        
        $resp = $this->common_model->edit('bussiness_listing', [ 'id' => $id ], $postData);

        $result = $this->common_model->get('bussiness_listing', ['id' => $id]);
        
        //$result = $this->common_model->deleteData('bussiness_listing', [ 'id' => $id ]);
       
        if ($resp) {
            $dt = json_encode([ 'status' => true , 'bussiness_status' => $result->status]);
        } else {
            $dt = json_encode([ 'status' => false, 'bussiness_status' => $result->status]);
        }
         echo $dt;
         exit;
    }
}
