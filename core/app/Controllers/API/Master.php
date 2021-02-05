<?php
namespace App\Controllers\API;

// REST FULL Resource
use CodeIgniter\RESTful\ResourceController;

use Firebase\JWT\JWT;

// Controllers
use App\Controllers\API\Auth;

// Models
use App\Models\Auth_Model;

class Master extends ResourceController
{
    public function __construct()
    {
        $this->protect = new Auth();
        $this->common_model = new Auth_Model();
        helper(['form','common']);
    }

    public function categoryAdd()
    {
        $data = [];

        $title = $this->request->getPost('title');
        $parentId = $this->request->getPost('parent_id');
        $status =  ($this->request->getPost('status')) ? $this->request->getPost('status') : '';

        if (!empty($title) && !empty($parentId)) {
            $categories = $this->common_model->add('categories', ['title' => $title, 'parent_id' => $parentId, 'status' => $status]);
            if ($categories == true) {
                $data = 'Category Added Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter Category title or Parent Id";
        }
        
        $secret_key = $this->protect->privateKey();

        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
       
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    public function categoryList()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $categories =$this->common_model->getResult('categories', ['id' => $id]);
        } else {
            $categories = $this->common_model->getResult('categories');
        }
        
        foreach ($categories as $key => $category) {
            $data[$key]['id'] = $category->id;
            $data[$key]['title'] = $category->title;
            $data[$key]['parent_id'] = $category->parent_id;
            $data[$key]['status'] = $category->status;
            $data[$key]['created_at'] = $category->created_at;
            $data[$key]['modified_at'] = $category->modified_at;
        }
        $secret_key = $this->protect->privateKey();

        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
       
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    public function categoryDelete()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $customers =$this->common_model->deleteData('categories', ['id' => $id]);
            if ($customers == true) {
                $data = 'Category Deleted Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter Category ID";
        }
        
        $secret_key = $this->protect->privateKey();
       
        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));

        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    public function categoryUpdate()
    {
        $data = [];

        $id = $this->request->getPost('id');
        $title = $this->request->getPost('title');
        $parentId = $this->request->getPost('parent_id');
        $status = $this->request->getPost('status');

        if (!empty($id)) {
            $categories =$this->common_model->edit('categories', ['id' => $id], ['title' => $title,'parent_id' => $parentId, 'status' => $status]);
            if ($categories == true) {
                $data = 'Category Updated Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter Category ID or Parent Id or Status";
        }
       
        $secret_key = $this->protect->privateKey();
       
        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));

        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    // Add Tags
    public function addTags()
    {
        $data = [];

        $title = $this->request->getPost('name');
        
        if (!empty($title)) {
            $tags = $this->common_model->add('tags', ['name' => $title]);
            if ($tags == true) {
                $data = 'Tags Added Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter Tags title";
        }
        
        $secret_key = $this->protect->privateKey();

        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
       
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    // Tags List
    public function tagsList()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $tags =$this->common_model->getResult('tags', ['id' => $id]);
        } else {
            $tags = $this->common_model->getResult('tags');
        }
        
        foreach ($tags as $key => $tag) {
            $data[$key]['id'] = $tag->id;
            $data[$key]['name'] = $tag->name;
            $data[$key]['created_at'] = $tag->created_at;
            $data[$key]['modified_at'] = $tag->modified_at;
        }
        $secret_key = $this->protect->privateKey();

        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
       
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    //Tags Update
    public function updateTags()
    {
        $data = [];

        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
       
        if (!empty($id)) {
            $tags =$this->common_model->edit('tags', ['id' => $id], ['name' => $name]);
            if ($tags == true) {
                $data = 'Tags Updated Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter Tags ID or Tag Name";
        }
       
        $secret_key = $this->protect->privateKey();
       
        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));

        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    //Tags Delete
    public function tagsDelete()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $tags =$this->common_model->deleteData('tags', ['id' => $id]);
            if ($tags == true) {
                $data = 'Tags Deleted Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter Tags ID";
        }
        
        $secret_key = $this->protect->privateKey();
       
        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));

        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    // Landing Page List
    public function landingPageList()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $pages =$this->common_model->getResult('pages', ['id' => $id]);
        } else {
            $pages = $this->common_model->getResult('pages');
        }
        
        foreach ($pages as $key => $page) {
            $data[$key]['id'] = $page->id;
            $data[$key]['title'] = $page->title;
            $data[$key]['slug'] = $page->slug;
            $data[$key]['content'] = $page->content;
            $data[$key]['created_at'] = $page->created_at;
            $data[$key]['modified_at'] = $page->modified_at;
        }
        $secret_key = $this->protect->privateKey();

        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
       
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    //Add Landing Page
    public function addLandingPage()
    {
        $data = [];

        $secret_key = $this->protect->privateKey();
       
        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));
                
                $rules = [
                    'title' => [
                        'label' => 'Title' ,
                        'rules' => 'required|min_length[6]',
                    ],
                    'content' => [
                        'label' => 'Content' ,
                        'rules' => 'required',
                    ],
                    'status' => [
                        'label' => 'Status' ,
                        'rules' => 'required',
                    ],
                ];

                // Validation Fields
                $val = $this->validate($rules);

                if (!$val) {
                    $error_text = '';
                    foreach ($this->validator->getErrors() as $keys => $error) {
                        $data['errors'][$keys] = $error;
                    }
                    
                    $output = [
                        'status'    => 404,
                        'message'   => 'Please enter required fields',
                        'error'     => $data,
                    ];
                    return $this->respond($output, 404);
                } else {
                    $postData = array(
                        'title' => $this->request->getPost('title'),
                        'slug' => str_replace(' ', '-', strtolower($this->request->getPost('title'))),
                        'content' => $this->request->getPost('content'),
                        'status' => $this->request->getPost('status'),
                    );

                    $resp = $this->common_model->add('pages', $postData);

                    if ($resp) {
                        $output = [
                            'message'   => 'Page Added successfully',
                            'status'    => 200
                        ];
                        return $this->respond($output, 200);
                    }
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    //Update Landing Page
    public function landingPageUpdate()
    {
        $data = [];
        $id = $this->request->getPost('id');
        $secret_key = $this->protect->privateKey();
       
        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if (!empty($id)) {
                    $rules = [
                        'title' => [
                            'label' => 'Title' ,
                            'rules' => 'required|min_length[6]',
                        ],
                        'content' => [
                            'label' => 'Content' ,
                            'rules' => 'required',
                        ],
                        'status' => [
                            'label' => 'Status' ,
                            'rules' => 'required',
                        ],
                    ];

                    // Validation Fields
                    $val = $this->validate($rules);

                    if (!$val) {
                        $error_text = '';
                        foreach ($this->validator->getErrors() as $keys => $error) {
                            $data['errors'][$keys] = $error;
                        }
                    
                        $output = [
                            'status'    => 404,
                            'message'   => 'Please enter required fields',
                            'error'     => $data,
                        ];
                        return $this->respond($output, 404);
                    } else {
                        $postData = array(
                            'title' => $this->request->getPost('title'),
                            'slug' => str_replace(' ', '-', strtolower($this->request->getPost('title'))),
                            'content' => $this->request->getPost('content'),
                            'status' => $this->request->getPost('status'),
                        );

                        $resp = $this->common_model->edit('pages', ['id' => $id], $postData);

                        if ($resp) {
                            $output = [
                            'message'   => 'Pages Updated successfully',
                            'status'    => 200
                            ];
                            return $this->respond($output, 200);
                        }
                    }
                } else {
                     $output = [
                        'message'   => 'Please Enter Page ID',
                        'status'    => 404
                     ];
                     return $this->respond($output, 404);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }
     //Landing Page Delete
    public function postDelete()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $pages =$this->common_model->deleteData('pages', ['id' => $id]);
            if ($pages == true) {
                $data = 'Page Deleted Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter Page ID";
        }
        
        $secret_key = $this->protect->privateKey();
       
        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));

        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

    // Interacts  Listing
    public function interactsList()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $interactions =$this->common_model->getResult('interactions', ['id' => $id]);
        } else {
            $interactions = $this->common_model->getResult('interactions');
        }
        
        foreach ($interactions as $key => $interaction) {
            $data[$key]['id']   = $interaction->id;
            $data[$key]['name'] = $interaction->name;
            $data[$key]['phone'] = $interaction->phone;
            $data[$key]['city'] = $interaction->city;
            $data[$key]['type'] = $interaction->type;
            $data[$key]['description'] = $interaction->description;
            $data[$key]['file'] = base_url('core/public/interact/'.$interaction->file);
            $data[$key]['created_at'] = $interaction->created_at;
            $data[$key]['modified_at'] = $interaction->modified_at;
        }
        $secret_key = $this->protect->privateKey();

        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
       
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }

     // Career Form Listing
    public function careerformList()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $careerForms =$this->common_model->getResult('career_form', ['id' => $id]);
        } else {
            $careerForms = $this->common_model->getResult('career_form');
        }
        
        foreach ($careerForms as $key => $careerForm) {
            $data[$key]['id']   = $careerForm->id;
            $data[$key]['name'] = $careerForm->name;
            $data[$key]['phone'] = $careerForm->phone;
            $data[$key]['city'] = $careerForm->city;
            $data[$key]['file'] = base_url('core/public/interact/'.$careerForm->file);
            $data[$key]['created_at'] = $careerForm->created_at;
            $data[$key]['modified_at'] = $careerForm->modified_at;
        }
        $secret_key = $this->protect->privateKey();

        $token = getToken($this->request->getServer('HTTP_AUTHORIZATION'));
       
        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                    'message' => 'Access Granted',
                    'data'    => $data
                    ];
                    return $this->respond($output, 200);
                }
            } catch (\Exception $e) {
                $output = [
                'message' => 'Access Denied',
                'error'   => $e->getMessage()
                ];
            
                return $this->respond($output, 401);
            }
        }
    }
} //Profile
