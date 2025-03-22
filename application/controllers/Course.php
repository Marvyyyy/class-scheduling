<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

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
		$sess_id = $this->session->userdata('logged_backend');
		if(empty($sess_id))
		{
			redirect('login');	  
		}
		$this->load->view('course');
	}
	function add_data(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('crs_title', 'Title', 'required');
			$this->form_validation->set_rules('crs_description', 'Description', 'required');
			
			$table = "tbl_course";
			$where = "crs_id";
			
				if ($this->input->post("insert") != '') {
					if($this->form_validation->run()){
						if ($this->input->post("crs_major") != '') {
							$crs_major = 'Major in '. $this->input->post("crs_major");
						} else {
							$crs_major = $this->input->post("crs_major");
						}
						
						$data = array(
							"crs_title" => $this->input->post("crs_title"),
							"crs_description" => $this->input->post("crs_description"),
							"crs_major" => $crs_major,
						);
						$this->Globalmodel->insert_data($data,$table);
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'title_error' => form_error('crs_title'),
							'description_error' => form_error('crs_description'),
							'error' => true
						);
						echo json_encode($form_error);
					}
				}
				elseif($this->input->post("update") != ''){
					if($this->form_validation->run()){
						if ($this->input->post("crs_major") != '') {
							$crs_major = 'Major in '. $this->input->post("crs_major");
						} else {
							$crs_major = $this->input->post("crs_major");
						}
						$data = array(
							"crs_title" => $this->input->post("crs_title"),
							"crs_description" => $this->input->post("crs_description"),
							"crs_major" => $crs_major,
						);
						// $id = $this->input->post("ID");
						$this->Globalmodel->update_data($data,$table,$where,$this->input->post("update"));
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'title_error' => form_error('crs_title'),
							'description_error' => form_error('crs_description'),
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
		$select='tbl_course.crs_id,tbl_course.crs_title,tbl_course.crs_description,tbl_course.crs_major';
		$table = 'tbl_course';
		$where='is_deleted = 0';
		$joinfrom = '';
		$join = '';
		$jointype = '';
		$list = $this->Globalmodel->selectwhere($select,$table,$where);
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
				  <button class="dropdown-item" onclick="edit('.$record->crs_id.');">Edit</button>
				  <button class="dropdown-item" onclick="deleteBtn('.$record->crs_id.');" >Delete</button>
				</div>
			  </div>';
			$row[] = $record->crs_id;
			$row[] = $record->crs_title;
			$row[] = $record->crs_description;
			$row[] = $record->crs_major;
			$row[] = $button;
			$data[] = $row;
		}
		$output = array (
			"data" => $data
		);
		echo json_encode($data);
	}

	function fetch_singledata(){
		$table = 'tbl_course';
		$where = 'crs_id';
		$id =  $this->input->post('idd');
		//* CRUD MODEL*//
		$data = $this->Globalmodel->fetch_single_data($id,$table,$where);
		//* CRUD MODEL*//
		echo json_encode($data);
	}
	function delete_data(){
		$table = 'tbl_course';
		$where = 'crs_id';
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

