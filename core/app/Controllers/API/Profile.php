<?php
namespace App\Controllers\API;

// REST FULL Resource
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

// Controllers
use App\Controllers\API\Auth;

// Models
use App\Models\Auth_Model;

class Profile extends ResourceController
{

    
    public function __construct()
    {

        $this->protect = new Auth();
        $this->common_model = new Auth_Model();
        helper(['form','common']);
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function getToken($authHeader)
    {

        $token = null;

        $arr = explode(" ", $authHeader);

        return $token = $arr[1];
    }

    public function access()
    {
        
        // Admin Secret Key
        $secret_key = $this->protect->privateKey();

        $token = $this->getToken($this->request->getServer('HTTP_AUTHORIZATION'));

        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $output = [
                        'message' => 'Access Granted',
                        'data'    => $resp->data
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

    public function interact()
    {
        
        // Admin Secret Key
        $secret_key = $this->protect->privateKey();

        $token = $this->getToken($this->request->getServer('HTTP_AUTHORIZATION'));

        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $validation =  \Config\Services::validation();

                    helper(['form', 'url']);

                    $val = $this->validate([
                        'name'      => ['label' => 'Name' ,         'rules' => 'required|min_length[5]'],
                        'phone'     => ['label' => 'Contact No.' ,  'rules' => 'required|min_length[5]'],
                        'city'      => ['label' => 'City' ,         'rules' => 'required'],
                        'type'      => ['label' => 'Type' ,         'rules' => 'required'],
                        'query'     => ['label' => 'Query' ,        'rules' => 'required|min_length[10]'],
                    ]);

                    if (!$val) {
                        $output = [
                            'status'    => 404,
                            'message'   => 'Please enter required fields',
                            'error'     => $validation->getErrors(),
                        ];
                        return $this->respond($output, 404);
                    } else {
                        $newName = '';
                        $file   = $this->request->getFile('file');
                        if ($file) {
                            $ext    = $file->getClientExtension();
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH.'public/interact', $newName);
                        }

                        $array = array(

                                    'name'          =>  $this->request->getPost('name'),
                                    'phone'         =>  $this->request->getPost('phone'),
                                    'city'          =>  $this->request->getPost('city'),
                                    'type'          =>  $this->request->getPost('type'),
                                    'description'   =>  $this->request->getPost('query'),
                                    'file'          =>  $newName,
                                );
                        $this->common_model->add('interactions', $array);


                        $output = [
                            'message'   => 'Interact sent successfully',
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

    public function career()
    {
        
        // Admin Secret Key
        $secret_key = $this->protect->privateKey();

        $token = $this->getToken($this->request->getServer('HTTP_AUTHORIZATION'));

        if ($token) {
            try {
                $resp = JWT::decode($token, $secret_key, array('HS256'));

                if ($resp) {
                    $validation =  \Config\Services::validation();

                    helper(['form', 'url']);

                    $val = $this->validate([
                        'name'      => ['label' => 'Name' ,         'rules' => 'required|min_length[5]'],
                        'phone'     => ['label' => 'Contact No.' ,  'rules' => 'required|min_length[5]'],
                        'city'      => ['label' => 'City' ,         'rules' => 'required']
                    ]);

                    if (!$val) {
                        $output = [
                            'status'    => 404,
                            'message'   => 'Please enter required fields',
                            'error'     => $validation->getErrors(),
                        ];
                        return $this->respond($output, 404);
                    } else {
                        $newName = '';
                        $file   = $this->request->getFile('file');
                        if ($file) {
                            $ext    = $file->getClientExtension();
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH.'public/career', $newName);
                        }

                        $array = array(

                                    'name'          =>  $this->request->getPost('name'),
                                    'phone'         =>  $this->request->getPost('phone'),
                                    'city'          =>  $this->request->getPost('city'),
                                    'file'          =>  $newName,
                                );
                        $this->common_model->add('career_form', $array);


                        $output = [
                            'message'   => 'Career form submitted successfully',
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

    //--------------------------------------------------------------------

    public function customersList()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $customers =$this->common_model->getResult('users', ['id' => $id]);
        } else {
            $customers = $this->common_model->getResult('users');
        }

        foreach ($customers as $key => $customer) {
            $data[$key]['id'] = $customer->id;
            $data[$key]['first_name'] = $customer->first_name;
            $data[$key]['last_name'] = $customer->last_name;
            $data[$key]['email'] = $customer->email;
            $data[$key]['phone'] = $customer->phone;
            $data[$key]['status'] = $customer->status;
            $data[$key]['email_verified'] = $customer->email_verified;
            $data[$key]['sms_verified'] = $customer->sms_verified;
            $data[$key]['admin_verified'] = $customer->admin_verified;
        }
       
        $secret_key = $this->protect->privateKey();

        $token = $this->getToken($this->request->getServer('HTTP_AUTHORIZATION'));

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

    public function customerDelete()
    {
        $data = [];

        $id = $this->request->getPost('id');

        if (!empty($id)) {
            $customers =$this->common_model->deleteData('users', ['id' => $id]);
            if ($customers == true) {
                $data = 'Customer Deleted Successfully';
            } else {
                $data = 'error..!! please try again later';
            }
        } else {
            $data = "Please Enter User ID";
        }
        
        $secret_key = $this->protect->privateKey();
       
        $token = $this->getToken($this->request->getServer('HTTP_AUTHORIZATION'));

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
