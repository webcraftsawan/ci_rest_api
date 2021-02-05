<?php namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Pages extends BaseController
{

	public function __construct(){
		
		$this->security = \Config\Services::security();

		$this->validation =  \Config\Services::validation();

		$this->session = \Config\Services::session();

		// Set Model
		$this->common_model = new Auth_Model();

		if(!$this->session->get('admin')){
			return redirect()->to(base_url('admin')); 
		}
	}

	public function index(){
		$data = [];
		$data['title'] = 'Pages';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/static-post-pages');
		$data['user'] = $this->session->get('admin');
		$data['pages'] = $this->common_model->get('pages');

		if($this->session->get('admin')){
			return view('admin/page/index' , $data);
		}else{
			return redirect()->to(base_url('admin'));
		}
	}

	public function create(){
		$data = [];
		$data['title'] = 'Add Pages';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/pages/store');

		$data['user'] = $this->session->get('admin');

		if($this->session->get('admin')){
			return view('admin/page/create' , $data);
		}else{
			return redirect()->to(base_url('admin')); 
		}
	}

	public function store(){
		$data = [];
		$data['title'] = 'Pages';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/pages/store');
		$data['user'] = $this->session->get('admin');

		// Validation Fields
		$val = $this->validate([
		    'title' 		=> [
		    	'label' => 'Title' ,
		     	'rules' => 'required',
	     	],
		    'content' 		=> [
    			'label' => 'Content' ,
    			'rules' => 'required',
    		],
		    'status' 		=> [
    			'label' => 'Status' ,
    			'rules' => 'required',
    		],
		]);

		// IF Validation Failed
		if(!$val){

			$data['errors'] = $this->validation->getErrors();
			return view('admin/page/create', $data);

		}else{

			$array = array(
					'title' => $this->request->getPost('title'),
					'slug' => str_replace(' ', '-', strtolower($this->request->getPost('title'))),
					'content' => $this->request->getPost('content'),
					'status' => $this->request->getPost('status'),
				);

			// check Login
			$add = $this->common_model->add('pages' , $array);

			if($add){
				$this->session->setFlashdata('success' , 'New page added successfully !!!');
			}else{
				$this->session->setFlashdata('warning' , 'Something went wrong !!!');
			}
			return redirect()->to(base_url('admin/pages')); 
		}
	}

	public function edit($id){
		$data = [];
		$data['title'] = 'Edit Page';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/pages/update/'.$id);

		$data['user'] = $this->session->get('admin');
		$data['page'] = $this->common_model->get('pages',['id' => $id]);

		if($this->session->get('admin')){
			return view('admin/page/create' , $data);
		}else{
			return redirect()->to(base_url('admin')); 
		}
	}

	public function update($id){
		$data = [];
		$data['title'] = 'Pages';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/pages/update/'.$id);
		$data['user'] = $this->session->get('admin');
		$data['page'] = $this->common_model->get('pages',['id' => $id]);
		
		// Validation Fields
		$val = $this->validate([
		    'title' 		=> [
		    	'label' => 'Title' ,
		     	'rules' => 'required',
	     	],
		    'content' 		=> [
    			'label' => 'Content' ,
    			'rules' => 'required',
    		],
		    'status' 		=> [
    			'label' => 'Status' ,
    			'rules' => 'required',
    		],
		]);

		// IF Validation Failed
		if(!$val){

			$data['errors'] = $this->validation->getErrors();
			return view('admin/page/create', $data);

		}else{

			$array = array(
				'title' => $this->request->getPost('title'),
				'slug' => str_replace(' ', '-', strtolower($this->request->getPost('title'))),
				'content' => $this->request->getPost('content'),
				'status' => $this->request->getPost('status'),
			);

			// check Login
			$add = $this->common_model->edit('pages' ,['id' => $id], $array);
			if($add){
				$this->session->setFlashdata('success' , 'page successfully updated');
			}else{
				$this->session->setFlashdata('warning' , 'something went wrong !!!');
			}
			return redirect()->to(base_url('admin/pages')); 
		}
	}

	public function delete($id){

		$delete = $this->common_model->deleteData('pages' ,['id' => $id]);

		if($delete){
			$this->session->setFlashdata('success' , 'page deleted');
		}else{
			$this->session->setFlashdata('warning' , 'something went wrong !!!');
		}
		return redirect()->to(base_url('admin/pages')); 
	}

}
