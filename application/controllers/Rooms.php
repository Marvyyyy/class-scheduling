<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {

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
		// $select='tbl_specialization.specialization_id,tbl_specialization.specialization_title';
		// $table = 'tbl_specialization';
		// $data['spec'] = $this->Globalmodel->select($select,$table,array());
		// $this->load->view('subjects',$data);
		$this->load->view('rooms');
	}
	function add_data(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('room', 'Room name', 'required');
			// $this->form_validation->set_rules('subj_code', 'Subject Code', 'required');
			
			$table = "tbl_room";
			$where = "room_id";
			
				if ($this->input->post("insert") != '') {
					if($this->form_validation->run()){
						$data = array(
							"room_name" => $this->input->post("room"),
							// "subj_code" => $this->input->post("subj_code"),
						);
						$this->Globalmodel->insert_data($data,$table);
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'room_error' => form_error('room'),
							// 'subj_code_error' => form_error('subj_code'),
							'error' => true
						);
						echo json_encode($form_error);
					}
				}
				elseif($this->input->post("update") != ''){
					if($this->form_validation->run()){
						$data = array(
							"room_name" => $this->input->post("room"),
							// "subj_code" => $this->input->post("subj_code"),
						);
						// $id = $this->input->post("ID");
						$this->Globalmodel->update_data($data,$table,$where,$this->input->post("update"));
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'room_error' => form_error('room'),
							// 'subj_code_error' => form_error('subj_code'),
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
		$select='tbl_room.room_id,tbl_room.room_name';
		$table = 'tbl_room';
		$where='tbl_room.is_deleted = 0';
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
				  <button class="dropdown-item" onclick="edit('.$record->room_id.');">Edit</button>
				  <button class="dropdown-item" onclick="deleteBtn('.$record->room_id.');" >Delete</button>
				</div>
			  </div>';
			$row[] = $record->room_id;
			$row[] = $record->room_name;
			// $row[] = $record->subj_code;
			$row[] = $button;
			$data[] = $row;
		}
		$output = array (
			"data" => $data
		);
		echo json_encode($data);
	}

	function fetch_singledata(){
		$table = 'tbl_room';
		$where = 'room_id';
		$id =  $this->input->post('idd');
		//* CRUD MODEL*//
		$data = $this->Globalmodel->fetch_single_data($id,$table,$where);
		//* CRUD MODEL*//
		echo json_encode($data);
	}
	function delete_data(){
		$table = 'tbl_room';
		$where = 'room_id';
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

