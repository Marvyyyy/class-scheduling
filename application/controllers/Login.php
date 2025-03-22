<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->model('Usermodel');
		$this->load->model('Globalmodel');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('login');
	}
	function check_user()
    {
		//echo "yes";
        $username = $this->input->post("username");
        $password = $this->input->post("password");
		$this->Usermodel->checkUser($username,$password);
	}
	function logout(){
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect("login");
	}

	// function login_validation(){
	// 	$this->load->library('form_validation');
	// 	$this->form_validation->set_rules('username', 'Username', 'required');
	// 	$this->form_validation->set_rules('password', 'Password', 'required');

	// 	if($this->form_validation->run()){
	// 		$username = $this->input->post('username');
	// 		$password = $this->input->post('password');
	// 		$this->load->model('main_model');
	// 		if($this->main_model->can_login($username, $password)){
	// 			$session_data = array(
	// 				'username' => $username,
	// 				'is_logged_in' => TRUE
	// 			);
	// 			$this->session->set_userdata($session_data);
	// 			redirect (base_url() . "main/dashboard");
	// 		}else{
	// 			$this->session->set_flashdata('error','Invalide Username and Password');
	// 			redirect (base_url() . "main/index");
	// 		}
	// 	}else{
	// 		$this->index();
	// 		$this->session->set_flashdata('variable_name', 'username');
	// 		$this->session->mark_as_temp(3, );
	// 	}
	// }
	// function enter(){
	// 	if($this->session->userdata('username') != ''){
	// 		// echo '<h2> Welcome - ' .$this->session->userdata('').'</h2>';
	// 		// echo '<label><a href="'.base_url().'main/logout">Logut</a></label>';
	// 		redirect (base_url() . "main/dashboard");
	// 	}else{
	// 		// redirect (base_url() . "main/login");
	// 		echo 'error';
	// 	}
	// }

	// function logout(){
	// 	$this->session->sess_destroy();
	// 	redirect();
	// }

	// function dashboard(){
	// 	$this->load->view('dashboard');
	// }

	// function fetch_data(){
	// 	$this->load->model('main_model');
	// 	$this->load->helper('url');
	// 	$list = $this->main_model->fetch_data();
	// 	$data = array();

	// 	foreach($list as $record) {
	// 		$row = array();

	// 		$row[] = $record->id;
	// 		$row[] = $record->first_name;
	// 		$row[] = $record->middle_name;
	// 		$row[] = $record->last_name;
	// 		$row[] = $record->sex;
	// 		$row[] = $record->nationality;
	// 		$row[] = '<button id="myBtn" class="button"><a href="'. base_url() ."main/update_data/". $record->id .'">Edit</a></button>';
	// 		//$row[] = '<button class="dt-center editor-edit"><a href="'. base_url() ."main/update_data/". $record->id .'"><i class="fa fa-pencil"/></button>';
	// 		$data[] = $row;
	// 	}

	// 	echo json_encode($data);
	// }

	// function form_validation(){
	// 	// echo 'form_validation';
	// 	$this->load->library('form_validation');
	// 	$this->form_validation->set_rules('first_name', 'First Name', 'required');
	// 	$this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
	// 	$this->form_validation->set_rules('last_name', 'Last Name', 'required');
	// 	$this->form_validation->set_rules('sex', 'Sex', 'required');
	// 	$this->form_validation->set_rules('nationality', 'Nationality', 'required');

	// 	if($this->form_validation->run()){
	// 		//true

	// 		$data = array(
	// 			"first_name" 	=> $this->input->post("first_name"),
	// 			"middle_name"	=> $this->input->post("middle_name"),
	// 			"last_name" 	=> $this->input->post("last_name"),
	// 			"sex" 			=> $this->input->post("sex"),
	// 			"nationality" 	=> $this->input->post("nationality")
	// 		);

	// 		$this->load->model('main_model');
	// 		if ($this->input->post("insert") != '') {
	// 			$this->main_model->insert_data($data);
	// 			// redirect(base_url() . "main/inserted");
	// 			$form_error = array(
	// 				'error' => FALSE
	// 			);
				
	// 			echo json_encode($form_error); // convert variable to json
	// 		}
	// 		if($this->input->post("update"  != '')){
	// 			$this->main_model->update_data($data, $this->input->post("hidden_id"));
	// 			redirect(base_url() . "main/updated");
	// 		}
	// 	} else {
	// 		// $this->session->set_flashdata('form_errors', form_error('username'));
	// 		$form_error = array(
	// 			'first_name_error' => form_error('first_name'),
	// 			'middle_name_error' => form_error('middle_name'),
	// 			'last_name_error' => form_error('last_name'),
	// 			'sex_error' => form_error('sex'),
	// 			'nationality_error' => form_error('nationality'),
	// 			'error' => true
	// 		);

	// 		echo json_encode($form_error);
	// 	}
	// }

	// function inserted(){
	// 	$this->dashboard();
	// }

	// function update_data(){
	// 	$user_id = $this->uri->segment(3);
	// 	$this->load->model('main_model');
	// 	$data['user_data'] = $this->main_model->fetch_single_data($user_id);
	// 	$data['fetch_data'] = $this->main_model->fetch_data();
	// 	$this->load->view('dashboard', $data);
	// }
	
}
?>

