<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('Profilemodel');
		$this->load->model('Globalmodel');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$sess_id = $this->session->userdata('logged_backend');
		if(empty($sess_id))
		{
			redirect('login');	  
		}
		$profile_id = $this->session->userdata('profile_id');
		$data['faculty'] = $this->Profilemodel->selectwhere('tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.lname,tbl_faculty.faculty_id,tbl_faculty.faculty_id','tbl_faculty','id = '.$profile_id,array());
		// $data['user'] = $this->Profilemodel->selectwhereusers('tbl_users','tbl_users.id='. $user_id ,array());
		$this->load->view('profile',$data);
	}
	function add_data(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_users.username]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirmpassword', 'Password', 'required|matches[password]');
			$this->form_validation->set_rules('role', 'Role', 'required');
			
			$table = "tbl_users";
			$where = "id";
			
				if ($this->input->post("insert") != '') {
					if($this->form_validation->run()){
							$password = $this->input->post("password");
						$data = array(
							"username" => $this->input->post("username"),
							"password" => md5($password),
							"role" => $this->input->post("role"),
						);
						$this->Globalmodel->insert_data($data,$table);
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'username_error' => form_error('username'),
							'password_error' => form_error('password'),
							'confirmpassword_error' => form_error('confirmpassword'),
							'role_error' => form_error('role'),
							'error' => true
						);
						echo json_encode($form_error);
					}
				}
				elseif($this->input->post("update") != ''){
					if($this->form_validation->run()){
						$password = $this->input->post("password");
						$data = array(
							"username" => $this->input->post("username"),
							"password" => md5($password),
							"role" => $this->input->post("role"),
						);
						// $id = $this->input->post("ID");
						$this->Globalmodel->update_data($data,$table,$where,$this->input->post("update"));
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'username_error' => form_error('username'),
							'password_error' => form_error('password'),
							'confirmpassword_error' => form_error('confirmpassword'),
							'role_error' => form_error('role'),
							'error' => true
						);
						echo json_encode($form_error);
					}
				}
			
		} else {
			echo "No direct script access allowed";
		}
	}
	function fetch_alldata(){
	
		//* CRUD MODEL*//
		$select='tbl_users.id,tbl_users.username,role.role_name';
		$table = 'tbl_users';
		$joinfrom = 'role';
		$join = 'role.id = tbl_users.role';
		$jointype = '';
		$list = $this->Globalmodel->selectjoin($select,$table,$joinfrom,$join,$jointype);
		$button = '';
		$data = array();

		foreach($list as $record) {
			$row = array();
				$button = '<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
				  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Action
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  <button class="dropdown-item" onclick="edit('.$record->id.');">Edit</button>
				  <button class="dropdown-item" onclick="deleteBtn('.$record->id.');" >Delete</button>
				</div>
			  </div>';
			$row[] = $record->id;
			$row[] = $record->username;
			$row[] = $record->role_name;
			$row[] = $button;
			$data[] = $row;
		}
		$output = array (
			"data" => $data
		);
		echo json_encode($data);
	}

	function fetch_singledata(){
		$table = 'tbl_users';
		$where = 'id';
		$id =  $this->input->post('idd');
		//* CRUD MODEL*//
		$data = $this->Globalmodel->fetch_single_data($id,$table,$where);
		//* CRUD MODEL*//
		echo json_encode($data);
	}
	function delete_data(){
		$table = 'tbl_users';
		$where = 'id';
		// $id = $this->input->post('idd');
		// $this->crud_model->delete_data($id,$table,$where);
		// echo "1";
		$data = array(
			"is_deleted" => '1',
		);
		// $id = $this->input->post("ID");
		$this->Globalmodel->update_data($data,$table,$where,$this->input->post("delete"));
	}

	

	
	
	
}
?>

