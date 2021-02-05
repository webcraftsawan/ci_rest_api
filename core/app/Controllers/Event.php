<?php 
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Event extends BaseController
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

	// Listings
	public function index(){

		$data = [];
		$data['title'] = 'Events';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/event/store');
		$data['user'] = $this->session->get('admin');
		$data['events'] = $this->common_model->get('events');

		if($this->session->get('admin')){
			return view('admin/events/index' , $data);
		}else{
			return redirect()->to(base_url('admin'));
		}
	}

	// Create Form Page
	public function create(){
 
		$data = [];
		$data['title'] = 'Create - Pool';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/event/store');
		$data['user'] = $this->session->get('admin');
		$data['resp'] = [];

		return view('admin/events/create' , $data);
	}

	// Insert data in DB
	public function store(){
		$data = [];
		$data['title'] = 'Create - Events';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/event/store');
		$data['user'] = $this->session->get('admin');

		$rules = [
		    'title' => [
		    	'label' => 'Title' ,
		     	'rules' => 'required|min_length[6]',
	     	],
		    'description'	=> [
    			'label' => 'Description' ,
    			'rules' => 'required|min_length[25]',
    		],
		    'status'	=> [
    			'label' => 'Status' ,
    			'rules' => 'required',
    		],
		    'from'	=> [
    			'label' => 'From Date' ,
    			'rules' => 'required',
    		],
		    'to'	=> [
    			'label' => 'To Date' ,
    			'rules' => 'required',
    		]
		];

		$start_date = strtotime($this->request->getPost('from'));
		$end_date = strtotime($this->request->getPost('to'));

		if($start_date > $end_date){
			$rules += array('resp_date' => [ 'label' => 'From Date' , 'rules' =>'valid_date' , 'errors' => [ 'valid_date' => 'End Date must be greater than Start Date' ] ] );
		}

		// Validation Fields
		$val = $this->validate($rules);

		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $keys => $error){
				$data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
			}

			return view('admin/events/create' , $data);

		}else{

			$postData = array(
				
				'title' 		=> $this->request->getPost('title'),
				
				'description' 	=> $this->request->getPost('description'),
				
				'start_date' 	=> $this->request->getPost('from'),
				
				'end_date' 		=> $this->request->getPost('to'),
				
				'status' 		=> $this->request->getPost('status'),
			
			);

			$resp = $this->common_model->add('events' , $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'Event created successfully');

				return redirect()->to(base_url('admin/event/list'));

			}

		}
	}

	// Edit Form Page
	public function edit($id){
		$data = [];
		$data['title'] = 'Edit - Events';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/event/update/'.$id);
		$data['user'] = $this->session->get('admin');

		$data['resp'] = $this->common_model->get('events' , ['id' => $id]);

		return view('admin/events/create' , $data);
	}

	// Update data in DB
	public function update($id){
		$data = [];
		$data['title'] = 'Update - Events';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/event/update/'.$id);
		$data['user'] = $this->session->get('admin');

		$data['resp'] = $this->common_model->get('events' , ['id' => $id]);
		
		$rules = [
		    'title' => [
		    	'label' => 'Title' ,
		     	'rules' => 'required|min_length[6]',
	     	],
		    'description'	=> [
    			'label' => 'Description' ,
    			'rules' => 'required|min_length[25]',
    		],
		    'status'	=> [
    			'label' => 'Status' ,
    			'rules' => 'required',
    		],
		    'from'	=> [
    			'label' => 'From Date' ,
    			'rules' => 'required',
    		],
		    'to'	=> [
    			'label' => 'To Date' ,
    			'rules' => 'required',
    		]
		];

		$start_date = strtotime($this->request->getPost('from')).'</br>';
		$end_date = strtotime($this->request->getPost('to'));

		if($start_date > $end_date){
			$rules += array('resp_date' => [ 'label' => 'From Date' , 'rules' =>'valid_date' , 'errors' => [ 'valid_date' => 'End Date must be greater than Start Date' ] ] );
		}

		// Validation Fields
		$val = $this->validate($rules);

		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $keys => $error){
				$data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
			}

			return view('admin/events/create' , $data);

		}else{

			$postData = array(
				
				'title' => $this->request->getPost('title'),
				
				'description' => $this->request->getPost('description'),
				
				'start_date' => $this->request->getPost('from'),
				
				'end_date' => $this->request->getPost('to'),
				
				'status' => $this->request->getPost('status'),
			
			);

			$resp = $this->common_model->edit('events' , [ 'id' => $id ],  $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'Event updated successfully');

				return redirect()->to(base_url('admin/event/list'));

			}

		}
	}

	// Delete data
	public function delete($id){

		$resp = $this->common_model->deleteData('events' , [ 'id' => $id ]);

		if($resp){
			
			$this->session->setFlashdata('success' , 'Pool deleted');

			return redirect()->to(base_url('admin/event/list'));

		}
	}

}
