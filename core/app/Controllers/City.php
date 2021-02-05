<?php 
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class City extends BaseController
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
		$data['title'] = 'City';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/cities/store');
		$data['user'] = $this->session->get('admin');
		$data['cities'] = $this->common_model->get('city');
		if($this->session->get('admin')){
			return view('admin/city/index' , $data);
		}else{
			return redirect()->to(base_url('admin'));
		}
	}

	// Create Form Page
	public function create(){
		$data = [];
		$data['title'] = 'Create - City';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/cities/store');
		$data['user'] = $this->session->get('admin');
		$data['resp'] = [];
		return view('admin/city/create' , $data);
	}

	// Insert data in DB
	public function store(){
		$data = [];
		$data['title'] = 'Create - City';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/cities/store');
		$data['user'] = $this->session->get('admin');

		$rules = [
		    'title' => [
		    	'label' => 'City Name' ,
		     	'rules' => 'required|min_length[3]',
	     	],
	     	'status' => [
		    	'label' => 'Status' ,
		     	'rules' => 'required',
	     	]
		];

		// Validation Fields
		$val = $this->validate($rules);

		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $keys => $error){
				$data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
			}

			return view('admin/city/create' , $data);

		}else{

			$postData = array(
				
				'name' 		=> $this->request->getPost('title'),

				'status' 	=> $this->request->getPost('status'),
			
			);

			$resp = $this->common_model->add('city' , $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'City created successfully');

				return redirect()->to(base_url('admin/cities'));

			}

		}
	}

	// Edit Form Page
	public function edit($id){
		$data = [];
		$data['title'] = 'Edit - City';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/cities/update/'.$id);
		$data['user'] = $this->session->get('admin');
		$data['resp'] = $this->common_model->get('city' , ['id' => $id]);
		return view('admin/city/edit' , $data);
	}

	// Update data in DB
	public function update($id){
		$data = [];
		$data['title'] = 'Update - City';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/cities/update/'.$id);
		$data['user'] = $this->session->get('admin');

		$data['resp'] = $this->common_model->get('city' , ['id' => $id]);
		
		$rules = [
		    'title' => [
		    	'label' => 'City name' ,
		     	'rules' => 'required|min_length[3]',
	     	],
	     	'status' => [
		    	'label' => 'Status' ,
		     	'rules' => 'required',
	     	]
		];

		// Validation Fields
		$val = $this->validate($rules);

		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $keys => $error){
				$data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
			}

			return view('admin/city/create' , $data);

		}else{

			$postData = array(
				
				'name' => $this->request->getPost('title'),

				'status' => $this->request->getPost('status'),
			
			);

			$resp = $this->common_model->edit('city' , [ 'id' => $id ],  $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'City updated successfully');

				return redirect()->to(base_url('admin/cities'));

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
