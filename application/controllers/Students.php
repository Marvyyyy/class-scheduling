<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

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
		$this->load->model('StudentModel');
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
		$data['sem'] = $this->StudentModel->selectjoin();
		$this->load->view('student',$data);
	}
	function add_data(){
		if ($this->input->is_ajax_request()) {
			// $this->form_validation->set_rules('role', '', 'required');
			$this->form_validation->set_rules('fname', '', 'required');
			$this->form_validation->set_rules('mname', '', 'required');
			$this->form_validation->set_rules('lname', '', 'required');
			$this->form_validation->set_rules('sy_name', '', 'required');
			$this->form_validation->set_rules('semester', '', 'required');
			$this->form_validation->set_rules('course', '', 'required');
			$this->form_validation->set_rules('section', '', 'required');
			
			$table = "tbl_users";
			$where = "id";
			
				if ($this->input->post("insert") != '') {
					if($this->form_validation->run()){
						$date1=date("Y",time());
						$date2=date('his');
						$formatid = substr($date1, -2).$date2;
						if ($this->input->post("idnumber") != '') {
							$idnumber = $this->input->post("idnumber");
						} else {
							$idnumber = $formatid;
						}
						$data = array(
							"student_id" => $idnumber,
							"fname" => $this->input->post("fname"),
							"mname" => $this->input->post("mname"),
							"lname" => $this->input->post("lname"),
							// "spec_code" => $this->input->post("sy_name"),
							// "spec_code" => $this->input->post("semester"),
							// "spec_code" => $this->input->post("course"),
							// "spec_code" => $this->input->post("section"),
						);
						$this->Globalmodel->insert_data($data,'tbl_students');
						$LastId = $this->db->insert_id();


						$sy_name = $this->input->post("sy_name");
						$semester = $this->input->post("semester");
						$course = $this->input->post("course");
						$section = $this->input->post("section");
						$list = $this->StudentModel->getClass($sy_name,$semester,$course,$section);
						foreach($list as $record){
							$row = array();
							$row[] = $record->class_id;
							$class[] = $row;
							
							$data = array(
								"student_id" => $LastId,
								"class_id" =>$record->class_id,
							);
							$this->Globalmodel->insert_data($data,'tbl_enroll');
						}

						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							// 'role_error' => form_error('role'),
							'fname_error' => form_error('fname'),
							'mname_error' => form_error('mname'),
							'lname_error' => form_error('lname'),
							'sy_name_error' => form_error('sy_name'),
							'semester_error' => form_error('semester'),
							'course_error' => form_error('course'),
							'section_error' => form_error('section'),
							'error' => true
						);
						echo json_encode($form_error);
					}
				}
				elseif($this->input->post("update") != ''){
					$this->form_validation->set_rules('idnumber', '', 'required');
					if($this->form_validation->run()){
						$data = array(
							"fname" => $this->input->post("fname"),
							"mname" => $this->input->post("mname"),
							"lname" => $this->input->post("lname"),
							"spec_code" => $this->input->post("spec"),
						);
						$this->Globalmodel->update_data($data,'tbl_faculty','id',$this->input->post("update"));
						$data = array(
							"username" => $this->input->post("idnumber"),
							// "password" => $idnumber,
							"role" => $this->input->post("role"),
							// "profile_id" => $insertedtID,
						);
						$this->Globalmodel->update_data($data,'tbl_users','profile_id',$this->input->post("profileID"));
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'idnumber_error' => form_error('idnumber'),
							'role_error' => form_error('role'),
							'fname_error' => form_error('fname'),
							'mname_error' => form_error('mname'),
							'lname_error' => form_error('lname'),
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
	
		$list = $this->StudentModel->gettAllStudents();
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
			  
			// $row[] = $record->id;
			$row[] = $record->student_id;
			$row[] = $record->lname .', '. $record->fname .', '. $record->mname;
			$row[] = $record->crs_title .' - '. $record->crs_major;
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
		$where = 'tbl_users.id';
		$joinfrom = 'tbl_faculty';
		$join = 'tbl_faculty.id = tbl_users.profile_id';
		$jointype = 'left';
		$id =  $this->input->post('idd');
		//* CRUD MODEL*//
		$data = $this->Globalmodel->fetch_single_data_join($id,$table,$where,$joinfrom,$join,$jointype);
		//* CRUD MODEL*//
		echo json_encode($data);
	}
	function delete_data(){
		$table = 'tbl_users';
		$where = 'profile_id';
		// $id = $this->input->post('idd');
		// $this->crud_model->delete_data($id,$table,$where);
		// echo "1";
		$data = array(
			"is_deleted" => '1',
		);
		// $id = $this->input->post("ID");
		$this->Globalmodel->update_data($data,$table,$where,$this->input->post("delete"));
	}

	function get_sub_category1(){
        $category_id = $this->input->post('id',TRUE);
        $data = $this->StudentModel->get_sub_category1($category_id);
        echo json_encode($data);
    }

	function get_sub_category2(){
        $category_id = $this->input->post('id',TRUE);
        $data = $this->StudentModel->get_sub_category2($category_id);
        echo json_encode($data);
    }

	
	
	
}
?>

