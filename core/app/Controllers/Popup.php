<?php 
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Popup extends BaseController
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
		$data['title'] = 'PopUp Images';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/store-popup-image');
		$data['user'] = $this->session->get('admin');
		$data['popups'] = $this->common_model->get('popups');

		if($this->session->get('admin')){
			return view('admin/popup-listing' , $data);
		}else{
			return redirect()->to(base_url('admin'));
		}
	}

	public function create(){
 

		$data = [];
		$data['title'] = 'Create - PopUp Images';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/store-popup-image');
		$data['user'] = $this->session->get('admin');
		$data['resp'] = [];

		return view('admin/create-popup-image' , $data);
	}

	public function store(){
		$data = [];
		$data['title'] = 'Create - PopUp Images';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/store-popup-image');
		$data['user'] = $this->session->get('admin');

		$file = $this->request->getFile('image');
		$ext = $file->getClientExtension();

		// $name = $file->getName();
		// $originalName = $file->getClientName();
		// $tempfile = $file->getTempName();
		// $type = $file->getClientMimeType();

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

		if(!$_FILES['image']['name']){
			$rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' ]);
		}

		$exts = ['jpg', 'jpeg' , 'png'];

		if(isset($_FILES['image']['name']) && !(in_array($ext , $exts))){
			$rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' , 'errors' => ['required' => 'Only jpg , png , jpeg images are allowed']]);
		}

		$start_date = strtotime($this->request->getPost('from')).'</br>';
		$end_date = strtotime($this->request->getPost('to'));
		// echo $start_date > $end_date;
		// exit;

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

			// $this->session->setFlashdata('error' , $error_text);

			return view('admin/create-popup-image' , $data);
			
			// return redirect()->to(base_url('admin/create-popup-image'));
		}else{

			$newName = $file->getRandomName();
			$file->move(ROOTPATH.'public/uploads', $newName);

			$postData = array(
				
				'title' => $this->request->getPost('title'),
				
				'description' => $this->request->getPost('description'),
				
				'image' => $newName,
				
				'from' => $this->request->getPost('from'),
				
				'to' => $this->request->getPost('to'),
				
				'is_active' => $this->request->getPost('status'),
			
			);

			$resp = $this->common_model->add('popups' , $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'Popup Image added successfully');

				return redirect()->to(base_url('admin/popup-images'));

			}

		}
	}

	public function edit($id){
		$data = [];
		$data['title'] = 'Edit - PopUp Images';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/update-popup-image/'.$id);
		$data['user'] = $this->session->get('admin');

		$data['resp'] = $this->common_model->get('popups' , ['id' => $id]);

		return view('admin/create-popup-image' , $data);
	}

	public function update($id){
		$data = [];
		$data['title'] = 'Create - PopUp Images';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/update-popup-image/'.$id);
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

		if(isset($_FILES['image']['name']) && $_FILES['image']['size'] > 0){
			
			$file = $this->request->getFile('image');
			
			$ext = $file->getClientExtension();
			
			$exts = ['jpg', 'jpeg' , 'png'];
			
			$newName = $file->getRandomName();

			if(!(in_array($ext , $exts))){
				
				$rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' , 'errors' => ['required' => 'Only jpg , png , jpeg images are allowed']]);
			
			}

		}

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

			return view('admin/create-popup-image' , $data);

		}else{

			$postData = array(
				
				'title' => $this->request->getPost('title'),
				
				'description' => $this->request->getPost('description'),
				
				'from' => $this->request->getPost('from'),
				
				'to' => $this->request->getPost('to'),
				
				'is_active' => $this->request->getPost('status'),
			
			);

			if(isset($_FILES['image']['name']) && $_FILES['image']['size'] > 0){
				$file = $this->request->getFile('image');
				$file->move(ROOTPATH.'public/uploads', $newName);
				$postData += [ 'image' => $newName ];
			}

			$resp = $this->common_model->edit('popups' , [ 'id' => $id ],  $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'Popup Image updated successfully');

				return redirect()->to(base_url('admin/popup-images'));

			}

		}
	}

	public function delete($id){

		$resp = $this->common_model->deleteData('popups' , [ 'id' => $id ]);

		if($resp){
			
			$this->session->setFlashdata('success' , 'Popup Image deleted');

			return redirect()->to(base_url('admin/popup-images'));

		}
	}

}
