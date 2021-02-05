<?php
namespace App\Controllers\API;

// REST FULL Resource
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

// Controllers
use App\Controllers\API\Auth;

// Models
use App\Models\Auth_Model;

class Post extends ResourceController
{
    public function __construct()
    {
        $this->protect = new Auth();
        $this->common_model = new Auth_Model();
        $this->security = \Config\Services::security();
        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        helper(['form','common']);
    }
    
    // Post List
    public function postList()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $posts =$this->common_model->getResult('posts', ['id' => $id]);
        } else {
            $posts = $this->common_model->getResult('posts');
        }
        
        foreach ($posts as $key => $post) {
            $data[$key]['id'] = $post->id;
            $data[$key]['title'] = $post->title;
            $data[$key]['description'] = $post->description;
            $data[$key]['image_url'] = base_url('core/public/posts/'.$post->image);
            $data[$key]['video_url'] = $post->video_url;
            $data[$key]['category_id'] = $post->category_id;
            $data[$key]['tags'] = $post->tags;
            $data[$key]['status'] = $post->status;
            $data[$key]['created_at'] = $post->created_at;
            $data[$key]['modifiead_at'] = $post->modifiead_at;
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

    //Add Post
    public function addPost()
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
                    'description'   => [
                        'label' => 'Description' ,
                        'rules' => 'required',
                    ],
                    'category_id'   => [
                        'label' => 'Category' ,
                        'rules' => 'required',
                    ],
                    'video_url' => [
                        'label' => 'Video URL' ,
                        'rules' => 'required',
                    ],
                    'tags'  => [
                        'label' => 'Tags' ,
                        'rules' => 'required',
                    ],
                    'status'    => [
                        'label' => 'Status' ,
                        'rules' => 'required',
                    ]
                ];

                $file = $this->request->getFile('image');

                if ($file) {
                    $ext = $file->getClientExtension();
                }

                if (!$_FILES['image']['name']) {
                    $rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' ]);
                }

                $exts = ['jpg', 'jpeg' , 'png'];

                if (isset($_FILES['image']['name']) && !(in_array($ext, $exts))) {
                    $rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' , 'errors' => ['required' => 'Only jpg , png , jpeg images are allowed']]);
                }

                $newName = 'no-image.png';
                if ($_FILES['image']['size'] > 0) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH.'public/posts', $newName);
                }
        
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
                
                        'title'         => $this->request->getPost('title'),
                        'description'   => $this->request->getPost('description'),
                        'category_id'   => $this->request->getPost('category_id'),
                        'video_url'     => $this->request->getPost('video_url'),
                        'image'         => $newName,
                        'tags'          => json_encode($this->request->getPost('tags')),
                        'status'        => $this->request->getPost('status'),
            
                    );

                    $resp = $this->common_model->add('posts', $postData);

                    if ($resp) {
                        $output = [
                            'message'   => 'Post Added successfully',
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

    //Update Post
    public function postUpdate()
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
                        'description'   => [
                            'label' => 'Description' ,
                            'rules' => 'required',
                        ],
                        'category_id'   => [
                            'label' => 'Category' ,
                            'rules' => 'required',
                        ],
                        'video_url' => [
                            'label' => 'Video URL' ,
                            'rules' => 'required',
                        ],
                        'tags'  => [
                            'label' => 'Tags' ,
                            'rules' => 'required',
                        ],
                        'status'    => [
                            'label' => 'Status' ,
                            'rules' => 'required',
                        ]
                    ];

                    $file = $this->request->getFile('image');

                    if ($file) {
                        $ext = $file->getClientExtension();
                    }

                    if (!$_FILES['image']['name']) {
                        $rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' ]);
                    }

                    $exts = ['jpg', 'jpeg' , 'png'];

                    if (isset($_FILES['image']['name']) && !(in_array($ext, $exts))) {
                        $rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' , 'errors' => ['required' => 'Only jpg , png , jpeg images are allowed']]);
                    }

                    $newName = 'no-image.png';
                    if ($_FILES['image']['size'] > 0) {
                        $newName = $file->getRandomName();
                        $file->move(ROOTPATH.'public/posts', $newName);
                    }
        
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
                        'title'         => $this->request->getPost('title'),
                        'description'   => $this->request->getPost('description'),
                        'category_id'   => $this->request->getPost('category_id'),
                        'video_url'     => $this->request->getPost('video_url'),
                        'image'         => $newName,
                        'tags'          => json_encode($this->request->getPost('tags')),
                        'status'        => $this->request->getPost('status'),
                        );

                        $resp = $this->common_model->edit('posts', ['id' => $id], $postData);

                        if ($resp) {
                            $output = [
                            'message'   => 'Post Updated successfully',
                            'status'    => 200
                            ];
                            return $this->respond($output, 200);
                        }
                    }
                } else {
                     $output = [
                        'message'   => 'Please Enter Post ID',
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

    //Post Delete
    public function postDelete()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $post =$this->common_model->deleteData('posts', ['id' => $id]);
            if ($post == true) {
                $data = 'Post Deleted Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter Post ID";
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
} //Post
