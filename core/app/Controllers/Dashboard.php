<?php namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Dashboard extends BaseController
{	

	public function __construct(){
		
		$this->security = \Config\Services::security();

		$this->validation =  \Config\Services::validation();

		$this->session = \Config\Services::session();

		// Set Model
		$this->common_model = new Auth_Model();


		helper (['form']);

		if(!$this->session->get('admin')){
			return redirect()->to(base_url('admin')); 
		}

	}

	public function index(){
		$data = [];
		$data['title'] = 'Dashboard';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['name_label'] = 'Username';
		$data['password_label'] = 'Password';
		$data['form_action'] = base_url('admin/login/post');
		$data['user'] = $this->session->get('admin');

		if($this->session->get('admin')){
			return view('admin/dashboard' , $data);
		}else{
			return redirect()->to(base_url('admin')); 
		}
	}

	public function changePassword(){
		$data = [];
		$data['title'] = 'Admin - Change Password';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/update-password');
		$data['user'] = $this->session->get('admin');

		if($this->session->get('admin')){
			return view('admin/change-password' , $data);
		}
	}

	public function updatePassword(){

		helper(['form', 'url']);

		$user_id = $this->request->getPost('id');
		$old_password = $this->request->getPost('old_password');

		$check_user = $this->common_model->get('admin' , ['id' => $user_id]);

		// Validation Fields
		$val = $this->validate([
		    'old_password' 	=> [ 'label' => 'Old Password' , 	'rules' => 'required|min_length[6]' ],
		    'new_password' 	=> [ 'label' => 'New Password' , 	'rules' => 'required|min_length[6]' ],
		    'cnf_password' 	=> [ 'label' => 'Confirm Password' , 'rules' => 'required|min_length[6]|matches[new_password]' ],
		]);

		// IF Validation Failed
		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $error){
				$error_text .= '<p>'.$error.'</p>';
			}

			$this->session->setFlashdata('warning' , $error_text);

			return redirect()->to(base_url('admin/change-password'));
		
		}else{

			// Password Verify
			if(isset($check_user) && password_verify($old_password , $check_user->password)){
				
				$password = $this->request->getPost('new_password');

				// Generate Password to hash password
				$password_hash = password_hash($password , PASSWORD_BCRYPT);

				$postData = [ 'password' => $password_hash ];

				$update_email_token = $this->common_model->edit('admin' , [ 'id' => $user_id ] , $postData);

				$this->session->setFlashdata('success' , 'Password changed successfully');

				return redirect()->to(base_url('admin/dashboard'));

			}else{

				$this->session->setFlashdata('error' , 'Invalid User or Old Password');

				return redirect()->to(base_url('admin/change-password'));

			}


		}
	}

}
