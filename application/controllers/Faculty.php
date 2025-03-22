<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller {

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
		// $this->load->model('Usermodel');
		$this->load->model('FacultyModel');
		$this->load->library('form_validation');
	}
	public function faculty_edit()
	{
		$sess_id = $this->session->userdata('logged_backend');
		if(empty($sess_id))
		{
			redirect('login');	  
		}
		// $data = $this->FacultyModel->fetch_single_data_join($this->input->post('idd'));
	// 	$subj =  $this->FacultyModel->fetch_single_data_join2($this->input->post('idd'));
		$id = $this->uri->segment(3);
		$data['subj'] = $this->FacultyModel->select('*','tbl_subject');
		$data['spec'] = $this->FacultyModel->faculty_spec();
		$data['faculty'] = $this->FacultyModel->fetch_single_data($this->uri->segment(3),'tbl_faculty','id');
		// $faculty_spec = $this->FacultyModel->selectwhere('*','tbl_specialization','faculty_id='.$id.'');
		// $data['faculty_spec'] = $faculty_spec;
		// $data['spec'] = $this->FacultyModel->selectwherearray('*','tbl_specialization','faculty_id='.$faculty_spec['subj_code'].'');
		$this->load->view('faculty_edit',$data);
	}
	public function index()
	{
		$sess_id = $this->session->userdata('logged_backend');
		if(empty($sess_id))
		{
			redirect('login');	  
		}
		$select='tbl_subject.subj_id,tbl_subject.subj_code';
		$table = 'tbl_subject';
		$data['subj'] = $this->FacultyModel->select($select,$table,array());
		// $this->load->view('faculty',$data);
		$this->load->view('faculty',$data);
	}
	function add_data(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('role', '', 'required');
			$this->form_validation->set_rules('fname', '', 'required');
			$this->form_validation->set_rules('mname', '', 'required');
			$this->form_validation->set_rules('lname', '', 'required');
			// $this->form_validation->set_rules('spec', '', 'required');
			
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
						// $spec = implode(',',$this->input->post("spec"));
						// $specs['spec'] = $spec;
						$data = array(
							"faculty_id" => $idnumber,
							"fname" => $this->input->post("fname"),
							"mname" => $this->input->post("mname"),
							"lname" => $this->input->post("lname"),
							"suffix" => $this->input->post("suffix"),
							// "spec_code" => $this->input->post("spec"),
							// "spec_code" => implode(',',$this->input->post("spec")),
						);
						$this->FacultyModel->insert_data($data,'tbl_faculty');

						//inset profile to tbl_faculty table
						$insertId = $this->db->insert_id();
						$data = array(
							"username" => $idnumber,
							"password" => md5($idnumber),
							"role" => $this->input->post("role"),
							"profile_id" => $insertId,
						);
						$this->FacultyModel->insert_data($data,'tbl_users');

						// insert specs to tbl_specialization table
						$spec = $this->input->post("subj");
						$faculty_id = $insertId;
						$data = array();
							foreach($spec AS $key ){
								$data[] = array(
								'faculty_id'=>$faculty_id,
								'subj_code'=>$spec[$key]
								);
								
						}
						$this->FacultyModel->insert_data_batch($data,'tbl_specialization');
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
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
				elseif($this->input->post("update") != ''){
					$this->form_validation->set_rules('idnumber', '', 'required');
					if($this->form_validation->run()){
						$data = array(
							"fname" => $this->input->post("fname"),
							"mname" => $this->input->post("mname"),
							"lname" => $this->input->post("lname"),
							"suffix" => $this->input->post("suffix"),
							"spec_code" => $this->input->post("spec"),
						);
						$this->FacultyModel->update_data($data,'tbl_faculty','id',$this->input->post("update"));
						$data = array(
							"username" => $this->input->post("idnumber"),
							// "password" => $idnumber,
							"role" => $this->input->post("role"),
							// "profile_id" => $insertedtID,
						);
						$this->FacultyModel->update_data($data,'tbl_users','profile_id',$this->input->post("profileID"));
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
	
		//* CRUD MODEL*//
		$select='tbl_faculty.id,tbl_users.username,tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.lname,tbl_faculty.suffix,tbl_specialization.faculty_id,role.role_name,(SELECT faculty_id, group_concat(subj_code) FROM tbl_specialization group_by faculty_id)';
		$table = 'tbl_users';
		$where='tbl_users.role = 3 ';
		$where2='tbl_users.role = 4 ';
		$where3='tbl_users.is_deleted = 0 ';
		$joinfrom = 'tbl_faculty';
		$join = 'tbl_faculty.id = tbl_users.profile_id';
		$jointype = 'left';
		$joinfrom2 = 'role';
		$join2 = 'role.role_id = tbl_users.role';
		$jointype2 = 'left';
		$joinfrom3 = 'tbl_specialization';
		$join3 = 'tbl_specialization.faculty_id = tbl_faculty.id';
		$jointype3 = 'left';
		// $joinfrom = 'tbl_specialization';
		// $join = 'tbl_specialization.specialization_id = tbl_faculty.spec_code';
		// $joinfrom = 'role';
		// $join = 'role.role_name = tbl_users.role';
		// $list = $this->FacultyModel->selectjoinwherefaculty($select,$table,$where,$where2,$where3,$joinfrom,$join,$jointype,$joinfrom2,$join2,$jointype2,$joinfrom3,$join3,$jointype3);
		$list = $this->FacultyModel->selectjoinwherefaculty2();
		// $list = $this->FacultyModel->selectjoinwherefaculty();
		$button = '';
		$data = array();

				  	// <!-- <button class="dropdown-item" onclick="edit('.$record->id.');">Edit</button>-->
					// <a class="dropdown-item" href="'.base_url().'faculty/faculty_edit/'.$record->id.'">Edit</a>
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
			$row[] = $record->suffix.' '.$record->lname .', '. $record->fname .', '. $record->mname;
			$row[] = $record->subj_code;
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
		$id =  $this->input->post('idd');
		$data = $this->FacultyModel->fetch_single_data_join($this->input->post('idd'));
		$subj =  $this->FacultyModel->fetch_single_data_join2($this->input->post('idd'));
		// $rows = $subj->num_rows();
		if(!empty($subj)){
			$output = array(
				"data" => $data,
				"subj" => $subj,
				"with_spec" => '1'
			);
			echo json_encode($output);
		}else{
			$output = array(
				"data" => $data,
			);
		echo json_encode($output);
		}
	}
	// function fetch_singledata(){
	// 	$id =  $this->input->post('idd');
	// 	$data = $this->FacultyModel->fetch_single_data_join($this->input->post('idd'));
	// 	// $subj =  $this->FacultyModel->fetch_single_data_join2($this->input->post('idd'));
	// 	foreach ($data as $result) {
    //         $value[] = (float) $result->subj_id;
    //     }
	// 	echo json_encode($value);
	// }
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
		$this->FacultyModel->update_data($data,$table,$where,$this->input->post("delete"));
	}

	
	
	
}
?>

