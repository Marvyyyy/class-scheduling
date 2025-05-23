<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curriculum extends CI_Controller {

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
		$this->load->model('Curriculummodel');
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
		$data['class'] = $this->Curriculummodel->selectjoin();
		$data['sem'] = $this->Globalmodel->select('tbl_semester.sem_id,tbl_semester.sem_description','tbl_semester',array());
		$data['course'] = $this->Globalmodel->selectwherearray('tbl_course.crs_id,tbl_course.crs_title,tbl_course.crs_major','tbl_course','is_deleted = "0"',array());
		// $data['faculty'] = $this->Globalmodel->select('tbl_faculty.id,tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.lname','tbl_faculty',array());
		$data['subj'] = $this->Globalmodel->selectwherearray('tbl_subject.subj_id,tbl_subject.subj_name','tbl_subject','is_deleted = "0"',array());
		$this->load->view('curriculum',$data);
	}
	function add_data(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('subject', 'Subject name', 'required');
			$this->form_validation->set_rules('spec', 'Specialization', 'required');
			
			$table = "tbl_subject";
			$where = "subj_id";
			
				if ($this->input->post("insert") != '') {
					if($this->form_validation->run()){
						$data = array(
							"subj_name" => $this->input->post("subject"),
							"spec_code" => $this->input->post("spec"),
						);
						$this->Globalmodel->insert_data($data,$table);
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'subject_error' => form_error('subject'),
							'spec_error' => form_error('spec'),
							'error' => true
						);
						echo json_encode($form_error);
					}
				}
				elseif($this->input->post("update") != ''){
					if($this->form_validation->run()){
						$data = array(
							"subj_name" => $this->input->post("subject"),
							"spec_code" => $this->input->post("spec"),
						);
						// $id = $this->input->post("ID");
						$this->Globalmodel->update_data($data,$table,$where,$this->input->post("update"));
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'subject_error' => form_error('subject'),
							'spec_error' => form_error('spec'),
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
		$select='tbl_subject.subj_id,tbl_subject.subj_name,tbl_specialization.specialization_title';
		$table = 'tbl_subject';
		$where='tbl_subject.is_deleted = 0';
		$joinfrom = 'tbl_specialization';
		$join = 'tbl_specialization.specialization_id = tbl_subject.spec_code';
		$jointype = 'left';
		$list = $this->Globalmodel->selectjoinwhere($select,$table,$where,$joinfrom,$join,$jointype);
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
				  <button class="dropdown-item" onclick="edit('.$record->subj_id.');">Edit</button>
				  <button class="dropdown-item" onclick="deleteBtn('.$record->subj_id.');" >Delete</button>
				</div>
			  </div>';
			$row[] = $record->subj_id;
			$row[] = $record->subj_name;
			$row[] = $record->specialization_title;
			$row[] = $button;
			$data[] = $row;
		}
		$output = array (
			"data" => $data
		);
		echo json_encode($data);
	}

	function fetch_singledata(){
		$table = 'tbl_subject';
		$where = 'subj_id';
		$id =  $this->input->post('idd');
		//* CRUD MODEL*//
		$data = $this->Globalmodel->fetch_single_data($id,$table,$where);
		//* CRUD MODEL*//
		echo json_encode($data);
	}
	function delete_data(){
		$table = 'tbl_subject';
		$where = 'subj_id';
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

