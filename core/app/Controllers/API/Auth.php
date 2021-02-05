<?php
namespace App\Controllers\API;

// REST FULL Resource
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

// Models
use App\Models\Auth_Model;

class Auth extends ResourceController
{

    public function __construct()
    {

        // Set Model
        $this->common_model = new Auth_Model();
    }

    public function privateKey()
    {
        $privateKey = <<<EOD
			-----BEGIN RSA PRIVATE KEY-----
			MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
			vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
			5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
			AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
			bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
			Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
			cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
			5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
			ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
			k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
			qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
			eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
			B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
			-----END RSA PRIVATE KEY-----
EOD;
        return $privateKey;
    }

    // User Register
    public function register()
    {

        $validation =  \Config\Services::validation();

        helper(['form', 'url']);

        $val = $this->validate([
            'first_name'    => ['label' => 'First Name' ,       'rules' => 'required|min_length[5]'],
            'last_name'     => ['label' => 'Last Name' ,        'rules' => 'required|min_length[5]'],
            'email'         => ['label' => 'Email' ,            'rules' => 'required|valid_email|is_unique[users.email]'],
            'phone'         => ['label' => 'Phone' ,            'rules' => 'required|min_length[10]|is_unique[users.phone]'],
            'password'      => ['label' => 'Password' ,         'rules' => 'required|min_length[6]'],
            'cnf_password'  => ['label' => 'Confirm Password' , 'rules' => 'required|min_length[6]|matches[password]'],
        ]);


        // $resp = $validation->withRequest($this->request)->run();
        if (!$val) {
            $output = [
                'status'    => 404,
                'message'   => 'Please enter required fields',
                'error'     => $validation->getErrors(),
            ];
            return $this->respond($output, 404);
        } else {
            $firstName  = $this->request->getPost('first_name');
            $lastName   = $this->request->getPost('last_name');
            $email      = $this->request->getPost('email');
            $phone      = $this->request->getPost('phone');
            $password   = $this->request->getPost('password');

            // Generate Password to hash password
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            // Store Data
            $post = array(
                'first_name'    => $firstName,
                'last_name'     => $lastName,
                'email'         => $email,
                'phone'         => $phone,
                'password'      => $password_hash
            );
            // Store Data to database via User Model
            $register = $this->common_model->add('users', $post);

            if ($register == true) {
                $output = [
                    'status'    => 200,
                    'message'   => 'User Successfully Registered'
                ];
                return $this->respond($output, 200);
            } else {
                $output = [
                    'status'    => 401,
                    'message'   => 'Something went wrong'
                ];
                return $this->respond($output, 401);
            }
        }
    }

    // User Login
    public function login()
    {
        // Validation Library
        $validation =  \Config\Services::validation();

        helper(['form', 'url']);

        // Validation Fields
        $val = $this->validate([
            'email'         => ['label' => 'Email' ,            'rules' => 'required|valid_email'],
            'password'      => ['label' => 'Password' ,         'rules' => 'required|min_length[6]'],
        ]);

        // IF Validation Failed
        if (!$val) {
            $output = [
                'status'    => 401,
                'message'   => 'Please enter required fields',
                'error'     => $validation->getErrors(),
            ];
            return $this->respond($output, 401);
        } else {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // check Login
            $check_login = $this->common_model->get('users', ['email' => $email]);
            $check_login = json_decode(json_encode($check_login), true);
            
            // Password Verify
            if (password_verify($password, $check_login['password'])) {
                // Success Login
                $secret_key = $this->privateKey();
                $issuer_claim = "THE_CLAIM";
                $audience_claim = "THE_AUDIANCE";
                $issuedat_claim = time();
                $notbefore_claim = $issuedat_claim + 10;
                $expire_claim = $issuedat_claim + 3600; // in seconds

                $token = [
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "data"=> [
                        'id'            => $check_login['id'],
                        'first_name'    => $check_login['first_name'],
                        'last_name'     => $check_login['last_name'],
                        'email'         => $check_login['email'],
                        'phone'         => $check_login['phone'],
                    ]
                ];
                // Generate Token
                $token = JWT::encode($token, $secret_key);
                
                $output = [
                    'status'    => 200,
                    'message'   => 'Login Successfully',
                    'token'     => $token,
                    'expireAt'  => $expire_claim
                ];
                //die('test');

                return $this->respond($output, 200);
            } else {
                $output = [
                    'status'    => 401,
                    'message'   => 'Login Failed',
                ];

                return $this->respond($output, 401);
            }
        }
    }

    // User Forgot Password
    public function forgot_password()
    {
        // Validation Library
        $validation =  \Config\Services::validation();

        helper(['form', 'url']);

        // Validation Fields
        $val = $this->validate([
            'email'         => ['label' => 'Email' ,            'rules' => 'required|valid_email'],
        ]);

        // IF Validation Failed
        if (!$val) {
            $output = [
                'status'    => 401,
                'message'   => 'Please enter required fields',
                'error'     => $validation->getErrors(),
            ];
            return $this->respond($output, 401);
        } else {
            $email = $this->request->getPost('email');

            // Check Email Exists
            $check_email_exists = $this->common_model->login($email);
            if ($check_email_exists) {
                $token = sha1(time());

                $to = $check_email_exists['email'];
                $subject = 'Forgot Password';
                $message = 'Click on password reset link to reset your password - '.base_url('reset/password/'.$token);

                $email = \Config\Services::email();

                $email->setFrom('developer@webcraft.co.in', 'Webcraft Developer');
                $email->setTo($to);

                // $email->setCC('another@another-example.com');
                // $email->setBCC('them@their-example.com');

                $email->setSubject($subject);
                $email->setMessage($message);
                $email->send();

                $postData = [ 'token' => $token ];
                $update_email_token = $this->common_model->updateData($check_email_exists['email'], $postData);

                $output = [
                    'status'    => 200,
                    'message'   => 'Password reset link sent to your email address',
                ];
                return $this->respond($output, 200);
            } else {
                $output = [
                    'status'    => 401,
                    'message'   => 'Email ID not exist',
                ];
                return $this->respond($output, 401);
            }
        }
    }

    // User Reset Password
    public function reset_password($token = "")
    {

        // IF Validation Failed
        if (!$token) {
            $output = [
                'status'    => 401,
                'message'   => 'Token is Invalid or Empty..!!!',
            ];
            return $this->respond($output, 401);
        } else {
            $data['token'] = $token;
            $data['validation'] = '';
            echo view('reset_password', $data);
        }
    }

    // User Reset Password Update
    public function reset_password_store()
    {

        // Validation Library
        $validation =  \Config\Services::validation();

        helper(['form', 'url']);

        // Validation Fields
        $val = $this->validate([
            'new_password'      => ['label' => 'New Password' ,     'rules' => 'required|min_length[6]'],
            'cnf_password'      => ['label' => 'Confirm Password' ,     'rules' => 'required|min_length[6]|matches[new_password]'],
        ]);

        // IF Validation Failed
        if (!$val) {
            $data = [
                'status'    => 401,
                'message'   => 'Please enter required fields',
                'token'     => $this->request->getPost('token'),
                'validation' => $this->validator,
            ];
            
            echo view('reset_password', $data);
        } else {
            $new_password = $this->request->getPost('new_password');
            $cnf_password = $this->request->getPost('cnf_password');

            // Generate Password to hash password
            $password_hash = password_hash($new_password, PASSWORD_BCRYPT);
            
            $token = $this->request->getPost('token');

            // Store Data
            $post = array(
                'password'      => $password_hash
            );
            $update_email_token = $this->common_model->updateData($token, $post);

            if ($update_email_token) {
                echo view('thankyou');
            } else {
                $data = [
                    'status'    => 401,
                    'message'   => 'Please enter required fields',
                    'token'     => $this->request->getPost('token'),
                    'validation' => '',
                ];
                
                echo view('reset_password', $data);
            }
        }
    }
}
