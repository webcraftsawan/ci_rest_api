<?php 
namespace App\Controllers;

// Models
use App\Models\Auth_Model;

class Post extends BaseController
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
		$data['title'] = 'Posts';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/post/store');
		$data['user'] = $this->session->get('admin');
		$data['posts'] = $this->common_model->get('posts');

		if($this->session->get('admin')){
			return view('admin/post/index' , $data);
		}else{
			return redirect()->to(base_url('admin'));
		}
	}

	// Create Form Page
	public function create(){
		$data = [];
		$data['title'] = 'Create - Post';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/posts/store');
		$data['user'] = $this->session->get('admin');
		$data['all_cats'] = $this->common_model->get('categories');
		$data['tags'] = $this->common_model->get('tags');
		$data['resp'] = [];
		return view('admin/post/create' , $data);
	}

	// Insert data in DB
	public function store(){
		$data = [];
		$data['title'] = 'Create - Posts';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/posts/store');
		$data['user'] = $this->session->get('admin');
		
		$data['all_cats'] = $this->common_model->get('categories');
		$data['tags'] = $this->common_model->get('tags');
		
		$rules = [
		    'title' => [
		    	'label' => 'Title' ,
		     	'rules' => 'required|min_length[6]',
	     	],
		    'description'	=> [
    			'label' => 'Description' ,
    			'rules' => 'required',
    		],
		    'category_id'	=> [
    			'label' => 'Category' ,
    			'rules' => 'required',
    		],
		    'video_url'	=> [
    			'label' => 'Video URL' ,
    			'rules' => 'required',
    		],
		    'tags'	=> [
    			'label' => 'Tags' ,
    			'rules' => 'required',
    		],
		    'status'	=> [
    			'label' => 'Status' ,
    			'rules' => 'required',
    		]
		];

		$file = $this->request->getFile('image');
		$ext = $file->getClientExtension();

		if(!$_FILES['image']['name']){
			$rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' ]);
		}

		$exts = ['jpg', 'jpeg' , 'png'];

		if(isset($_FILES['image']['name']) && !(in_array($ext , $exts))){
			$rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' , 'errors' => ['required' => 'Only jpg , png , jpeg images are allowed']]);
		}

		$newName = 'no-image.png';
		if($_FILES['image']['size'] > 0){
			$newName = $file->getRandomName();
			$file->move(ROOTPATH.'public/posts', $newName);
		}

		// Validation Fields
		$val = $this->validate($rules);

		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $keys => $error){
				$data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
			}

			return view('admin/post/create' , $data);

		}else{

			$postData = array(
				
				'title' 		=> $this->request->getPost('title'),
				'description' 	=> $this->request->getPost('description'),
				'category_id' 	=> $this->request->getPost('category_id'),
				'video_url'		=> $this->request->getPost('video_url'),
				'image' 		=> $newName,
				'tags'			=> json_encode($this->request->getPost('tags')),
				'status' 		=> $this->request->getPost('status'),
			
			);

			$resp = $this->common_model->add('posts' , $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'Post created successfully');

				return redirect()->to(base_url('admin/posts/list'));

			}

		}
	}

	// Edit Form Page
	public function edit($id){
		$data = [];
		$data['title'] = 'Edit - Category';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/posts/update/'.$id);
		$data['user'] = $this->session->get('admin');
		$data['resp'] = $this->common_model->get('posts' , ['id' => $id]);
		$data['all_cats'] = $this->common_model->get('categories');
		$data['tags'] = $this->common_model->get('tags');
		return view('admin/post/edit' , $data);
	}

	// Update data in DB
	public function update($id){
		$data = [];
		$data['title'] = 'Update - Category';
		$data['description'] = '';
		$data['keywords'] = '';
		$data['form_action'] = base_url('admin/posts/update/'.$id);
		$data['user'] = $this->session->get('admin');
		$data['all_cats'] = $this->common_model->get('categories');

		$data['resp'] = $this->common_model->get('posts' , ['id' => $id]);
		
		$data['all_cats'] = $this->common_model->get('categories');
		$data['tags'] = $this->common_model->get('tags');
		
		$rules = [
		    'title' => [
		    	'label' => 'Title' ,
		     	'rules' => 'required|min_length[6]',
	     	],
		    'description'	=> [
    			'label' => 'Description' ,
    			'rules' => 'required',
    		],
		    'category_id'	=> [
    			'label' => 'Category' ,
    			'rules' => 'required',
    		],
		    'video_url'	=> [
    			'label' => 'Video URL' ,
    			'rules' => 'required',
    		],
		    'tags'	=> [
    			'label' => 'Tags' ,
    			'rules' => 'required',
    		],
		    'status'	=> [
    			'label' => 'Status' ,
    			'rules' => 'required',
    		]
		];

		$ext = '';
		if(isset($_FILES['image']['name']) && $_FILES['image']['size'] > 0){
			$file = $this->request->getFile('image');
			$ext = $file->getClientExtension();
		}

		$exts = ['jpg', 'jpeg' , 'png'];

		if(isset($_FILES['image']['name'])  && $_FILES['image']['size'] > 0 && !(in_array($ext , $exts))){
			$rules += array('image' => [ 'label' => 'Image' , 'rules' => 'required' , 'errors' => ['required' => 'Only jpg , png , jpeg images are allowed']]);
		}

		$newName = 'no-image.png';
		if($_FILES['image']['size'] > 0){
			$newName = $file->getRandomName();
			$file->move(ROOTPATH.'public/posts', $newName);
		}

		// Validation Fields
		$val = $this->validate($rules);

		if(!$val){

			$error_text = '';
			foreach($this->validator->getErrors() as $keys => $error){
				$data['errors'][$keys] = '<p><small>'.$error.'</small></p>';
			}

			return view('admin/post/create' , $data);

		}else{

			$postData = array(
				'title' 		=> $this->request->getPost('title'),
				'description' 	=> $this->request->getPost('description'),
				'category_id' 	=> $this->request->getPost('category_id'),
				'video_url'		=> $this->request->getPost('video_url'),
				'tags'			=> json_encode($this->request->getPost('tags')),
				'status' 		=> $this->request->getPost('status'),
			);

			if($_FILES['image']['size'] > 0){
				$postData += array( 'image' => $newName );
			}

			$resp = $this->common_model->edit('posts' , ['id' => $id] , $postData);

			if($resp){
				
				$this->session->setFlashdata('success' , 'Post updated successfully');

				return redirect()->to(base_url('admin/posts/list'));

			}

		}
	}

	// Delete data
	public function delete($id){

		$resp = $this->common_model->deleteData('posts' , [ 'id' => $id ]);

		if($resp){
			
			$this->session->setFlashdata('success' , 'Post deleted');

			return redirect()->to(base_url('admin/posts/list'));

		}
	}

}