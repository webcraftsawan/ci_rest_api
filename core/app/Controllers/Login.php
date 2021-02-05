<?php namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Login extends BaseController
{	

	public function __construct(){
		
		$this->security = \Config\Services::security();

		$this->validation =  \Config\Services::validation();

		$this->session = \Config\Services::session();

		// Set Model
		$this->common_model = new Auth_Model();

	}

	public function index(){

		$data = [];
		$data['title'] = 'Admin Login';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['name_label'] = 'Username';
		$data['password_label'] = 'Password';
		$data['form_action'] = base_url('admin/login/post');
		return view('admin/login', $data);
	}

	public function post(){

		$data = [];
		$data['title'] = 'Admin Login';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['name_label'] = 'Username';
		$data['password_label'] = 'Password';
		$data['form_action'] = base_url('admin/login/post');

		// Validation Fields
		$val = $this->validate([
		    'username' 		=> [
		    	'label' => 'Username' ,
		     	'rules' => 'required',
	     	],
		    'password' 		=> [
    			'label' => 'Password' ,
    			'rules' => 'required|min_length[6]',
    		],
		]);

		// IF Validation Failed
		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $error){
				$error_text .= '<p>'.$error.'</p>';
			}

			$this->session->setFlashdata('warning' , $error_text);

			return redirect()->to(base_url('admin'));

			// $data['errors'] = $this->validation->getErrors();
			// return view('admin/login', $data);

		}else{

			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');

			// Generate Password to hash password
			// $password_hash = password_hash($password , PASSWORD_BCRYPT);

			// check Login
			$check_login = $this->common_model->login($username);
			
			// Password Verify
			if(isset($check_login) && password_verify($password , $check_login['password'])){
				
				$sessionSet = [
							'id' 		=> $check_login['id'],
				    		'name' 		=> $check_login['name'],
				    		'username' 	=> $check_login['username'],
				    		'email' 	=> $check_login['email'],
				    		'phone' 	=> $check_login['phone']
				    	];

		    	$this->session->set('admin' , $sessionSet);

				$this->session->setFlashdata('success' , 'LogIn Success');

		    	return redirect()->to(base_url('admin/dashboard')); 

			}else{

				$this->session->setFlashdata('warning' , 'Invalid Username and Password');

				return redirect()->to(base_url('admin')); 
			}

		}

	}

	public function logout(){
		if($this->session->get('admin')){
			$this->session->remove('admin');
			return redirect()->to(base_url('admin')); 
		}else{
			return redirect()->to(base_url('admin/dashboard')); 
		}
	}

	public function forgotPassword(){

		$data = [];
		$data['title'] = 'Admin - Forgot Password';
		$data['description'] = '';
		$data['keywords'] = '';

		$data['form_action'] = base_url('admin/forgot-password-request');

		return view('admin/forgot-password',$data);
	}

	public function forgotPasswordRequest(){

		$data = [];
		$data['title'] = 'Forgot Password';
		$data['description'] = '';
		$data['keywords'] = '';

		$data['form_action'] = base_url('admin/forgot-password-request');

		$token = sha1(time());

		$to = $this->request->getPost('email');

		$check_email = $this->common_model->get('admin',['email' => $to ]);

		if($check_email){
			
			$subject = 'Forgot Password';
			$message = '<p>Hello Admin , </p>';
			$message .= '<p>Click on password reset link to reset your password - <a href="'.base_url('reset/password/'.$token).'">click here</a></p>';
			$message .= '<p>Thankyou</p>';
			
			$email = \Config\Services::email();

			$email->setFrom('developer@webcraft.co.in', 'Webcraft Developer');
			$email->setTo($to);

			$email->setSubject($subject);
			$email->setMessage($message);
			$email->send();

			$postData = [ 'token' => $token ];
			$update_email_token = $this->common_model->edit('admin' , ['email' => $to] , $postData);

			$this->session->setFlashdata('success' , 'Forgot password mail sent..!!!');

			return redirect()->to(base_url('admin'));

		}else{
			$this->session->setFlashdata('warning' , 'Invalid Email Id');
			
			return redirect()->to(base_url('admin/forgot-password'));

		}
	}

	public function resetPassword($token){
		$data = [];
		$data['title'] = 'Reset Password';
		$data['description'] = '';
		$data['keywords'] = '';

		$data['form_action'] = base_url('admin/reset-password/update/'.$token);

		$data['user'] = $this->common_model->get('admin',['token' => $token ]);

		return view('admin/reset-password',$data);
	}

	public function resetPasswordPost($token){
		// Validation Library
		$validation =  \Config\Services::validation();

		helper(['form', 'url']);

		// Validation Fields
		$val = $this->validate([
		    'new_password' 		=> ['label' => 'New Password' , 	'rules' => 'required|min_length[6]'],
		    'cnf_password' 		=> ['label' => 'Confirm Password' , 	'rules' => 'required|min_length[6]|matches[new_password]'],
		]);

		// IF Validation Failed
		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $error){
				$error_text .= '<p>'.$error.'</p>';
			}

			$this->session->setFlashdata('warning' , $error_text);

			return redirect()->to(base_url('admin/reset/password/'.$token));
		
		}else{

			$password = $this->request->getPost('new_password');

			// Generate Password to hash password
			$password_hash = password_hash($password , PASSWORD_BCRYPT);

			$postData = [ 'password' => $password_hash ];

			$update_email_token = $this->common_model->edit('admin' , [ 'token' => $token ] , $postData);

			$this->session->setFlashdata('success' , 'Password reset successfully');

			return redirect()->to(base_url('admin'));

		}
	}

}
