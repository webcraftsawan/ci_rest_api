<?php 
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Customers extends BaseController
{
	
	public function __construct(){
		
		$this->security = \Config\Services::security();

		$this->validation =  \Config\Services::validation();

		$this->session = \Config\Services::session();

		// Set Model
		$this->common_model = new Auth_Model();

		helper (['form','common']);

		if(!$this->session->get('admin')){
			return redirect()->to(base_url('admin')); 
		}
	}

	// Listings
	public function index(){

		$data = [];
		$data['title'] = 'Customers';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/customers/store');
		$data['user'] = $this->session->get('admin');
		$data['customers'] = $this->common_model->get('users');

		if($this->session->get('admin')){
			return view('admin/customers/index' , $data);
		}else{
			return redirect()->to(base_url('admin'));
		}
	}

	// Create Form Page
	public function create(){
		$data = [];
		$data['title'] = 'Create - Tags';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/tags/store');
		$data['user'] = $this->session->get('admin');
		$data['resp'] = [];
		return view('admin/tags/create' , $data);
	}

	// Insert data in DB
	public function store(){
		$data = [];
		$data['title'] = 'Create - Tags';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/tags/store');
		$data['user'] = $this->session->get('admin');

		$rules = [
		    'title' => [
		    	'label' => 'Title' ,
		     	'rules' => 'required|min_length[3]',
	     	]
		];

		// Validation Fields
		$val = $this->validate($rules);

		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $keys => $error){
				$data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
			}

			return view('admin/tags/create' , $data);

		}else{

			$postData = array(
				
				'name' 		=> $this->request->getPost('title'),
			
			);

			$resp = $this->common_model->add('tags' , $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'Tag created successfully');

				return redirect()->to(base_url('admin/tags/list'));

			}

		}
	}

	// Edit Form Page
	public function edit($id){
		$data = [];
		$data['title'] = 'Edit - Tags';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/tags/update/'.$id);
		$data['user'] = $this->session->get('admin');
		$data['resp'] = $this->common_model->get('tags' , ['id' => $id]);
		return view('admin/tags/edit' , $data);
	}

	// Update data in DB
	public function update($id){
		$data = [];
		$data['title'] = 'Update - Tags';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/tags/update/'.$id);
		$data['user'] = $this->session->get('admin');
		$data['all_cats'] = $this->common_model->get('tags');

		$data['resp'] = $this->common_model->get('tags' , ['id' => $id]);
		
		$rules = [
		    'title' => [
		    	'label' => 'Title' ,
		     	'rules' => 'required|min_length[3]',
	     	]
		];

		// Validation Fields
		$val = $this->validate($rules);

		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $keys => $error){
				$data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
			}

			return view('admin/tags/create' , $data);

		}else{

			$postData = array(
				
				'name' => $this->request->getPost('title'),
			
			);

			$resp = $this->common_model->edit('tags' , [ 'id' => $id ],  $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'Tag updated successfully');

				return redirect()->to(base_url('admin/tags/list'));

			}

		}
	}


	// View Form Page
	public function view($id){
		$data = [];
		$data['title'] = 'View - Customer';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/customers/update/'.$id);
		$data['user'] = $this->session->get('admin');
		$data['resp'] = $this->common_model->get('users' , ['id' => $id]);
		return view('admin/customers/view' , $data);
	}

	// Delete data
	public function delete($id){

		$resp = $this->common_model->deleteData('tags' , [ 'id' => $id ]);

		if($resp){
			
			$this->session->setFlashdata('success' , 'Tag deleted');

			return redirect()->to(base_url('admin/tags/list'));

		}
	}

}
