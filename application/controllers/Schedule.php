<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

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
		$this->load->model('Schedulemodel');
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
		
		$data['student'] = $this->Globalmodel->select('tbl_students.fname,tbl_students.mname,tbl_students.lname','tbl_students',array());
		$data['sy'] = $this->Globalmodel->select('tbl_schoolyear.id,tbl_schoolyear.sy_name','tbl_schoolyear',array());
		$data['sem'] = $this->Globalmodel->select('tbl_semester.sem_id,tbl_semester.sem_description','tbl_semester',array());
		$data['course'] = $this->Globalmodel->selectwherearray('tbl_course.crs_id,tbl_course.crs_title,tbl_course.crs_major','tbl_course','is_deleted = "0"',array());
		$data['faculty'] = $this->Globalmodel->select('tbl_faculty.id,tbl_faculty.suffix,tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.lname','tbl_faculty',array());
		$data['subj'] = $this->Globalmodel->selectwherearray('tbl_subject.subj_id,tbl_subject.subj_name,tbl_subject.subj_code','tbl_subject','is_deleted = "0"',array());
		$data['room'] = $this->Globalmodel->selectwherearray('tbl_room.room_id,tbl_room.room_name','tbl_room','is_deleted = "0"',array());
		$this->load->view('schedule',$data);
	}
	function add_data(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('sy_name', '', 'required');
			$this->form_validation->set_rules('sem', '', 'required');
			$this->form_validation->set_rules('course', '', 'required');
			$this->form_validation->set_rules('faculty', '', 'required');
			$this->form_validation->set_rules('subject', '', 'required');
			$this->form_validation->set_rules('start_time', '', 'required');
			$this->form_validation->set_rules('end_time', '', 'required');
			$this->form_validation->set_rules('room', '', 'required');
			
			$table = "tbl_class";
			$where = "class_id";
			
				if ($this->input->post("insert") != '') {
					if($this->form_validation->run()){
						$data = array(
							"school_yr" => $this->input->post("sy_name"),
							"semester" => $this->input->post("sem"),
							"course_id" => $this->input->post("course"),
							"faculty_id" => $this->input->post("faculty"),
							"subj_code" => $this->input->post("subject"),
							"time_start" => $this->input->post("start_time"),
							"time_end" => $this->input->post("end_time"),
							"day1" => $this->input->post("day1"),
							"day2" => $this->input->post("day2"),
							"day3" => $this->input->post("day3"),
							"day4" => $this->input->post("day4"),
							"day5" => $this->input->post("day5"),
							"day6" => $this->input->post("day6"),
							"room_id" => $this->input->post("room"),
						);
						$this->Globalmodel->insert_data($data,$table);
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'sy_name_error' => form_error('sy_name'),
							'sem_error' => form_error('sem'),
							'course_error' => form_error('course'),
							'faculty_error' => form_error('faculty'),
							'subject_error' => form_error('subject'),
							'start_time_error' => form_error('start_time'),
							'end_time_error' => form_error('end_time'),
							'room_error' => form_error('room'),
							'error' => true
						);
						echo json_encode($form_error);
					}
				}
				elseif($this->input->post("update") != ''){
					if($this->form_validation->run()){
						$data = array(
							"school_yr" => $this->input->post("sy_name"),
							"semester" => $this->input->post("sem"),
							"course_id" => $this->input->post("course"),
							"faculty_id" => $this->input->post("faculty"),
							"subj_code" => $this->input->post("subject"),
							"time_start" => $this->input->post("start_time"),
							"time_end" => $this->input->post("end_time"),
							"day1" => $this->input->post("day1"),
							"day2" => $this->input->post("day2"),
							"day3" => $this->input->post("day3"),
							"day4" => $this->input->post("day4"),
							"day5" => $this->input->post("day5"),
							"day6" => $this->input->post("day6"),
							"room_id" => $this->input->post("room"),
						);
						// $id = $this->input->post("ID");
						$this->Globalmodel->update_data($data,$table,$where,$this->input->post("update"));
						$form_error = array(
							'error' => FALSE
						);
						echo json_encode($form_error);
					} else {
						$form_error = array(
							'sy_name_error' => form_error('sy_name'),
							'sem_error' => form_error('sem'),
							'course_error' => form_error('course'),
							'faculty_error' => form_error('faculty'),
							'subject_error' => form_error('subject'),
							'start_time_error' => form_error('start_time'),
							'end_time_error' => form_error('end_time'),
							'room_error' => form_error('room'),
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
		// $select='*,tbl_faculty.faculty_id';
		// $table = 'tbl_class';
		// $where='tbl_class.class_id != 0';
		// $joinfrom = 'tbl_faculty';
		// $join = 'tbl_faculty.id = tbl_class.faculty_id';
		// $jointype = 'left';
		// $searchfilterType = $_POST['searchfilterType'];
        // $searchcourseType = $_POST['searchcourseType'];
		// $searchfacultyType = $_POST['searchfacultyType'];
		// $searchstudentType = $_POST['searchstudentType'];
		// $syType = $_POST['syType'];
		// $semType = $_POST['semType'];

		$searchfilterType = $this->input->post("searchfilterType");
        $searchcourseType = $this->input->post("searchcourseType");
		$searchfacultyType = $this->input->post("searchfacultyType");
		$searchstudentType = $this->input->post("searchstudentType");
		$searchsyType = $this->input->post("searchsyType");
		$searchsemType = $this->input->post("searchsemType");
		// "school_yr" => $this->input->post("sy_name"),
		// if ($searchfilterType == ''){
		// 	// $list = $this->Schedulemodel->selectjoinwhere();
		// }
		// elseif ($searchfilterType != ''){
		$searchCourse = "";
		$searchFaculty = "";
		$searchSY = "";
		$searchSem = "";
		$searchStudent = "";
			// if ($searchfilterType == 'Course'){
			// 	// $list = $this->Schedulemodel->selectjoinwherecourse($syType,$semType);
			// 	$searchfacultyType = "";
			// }
			if ($searchfacultyType != ''){
				$searchFaculty = "AND tbl_class.faculty_id = $searchfacultyType ";
				$and="AND";
			}else{$and="AND";}
			// if ($searchstudentType != ''){
			// 	$searchStudent = "WHERE tbl_enroll.student_id = $searchstudentType ";
			// 	$and="AND";
			// }else{$and="WHERE";}
			if ($searchcourseType != ''){
				// $list = $this->Schedulemodel->selectjoinwherecourse($syType,$semType);
				$searchCourse = "$and tbl_class.course_id = $searchcourseType";
			}
			// elseif ($searchfilterType == 'Student'){
			// 	$searchCourse = "WHERE tbl_class.course_id = '.$searchcourseType.'";
			// }
			if ($searchsyType != ''){
				$searchSY = "AND tbl_class.school_yr = $searchsyType";
			}
			if ($searchsemType != ''){
				$searchSem = "AND tbl_class.course_id = $searchsemType";
			}
		// // }
		// elseif($searchfilterType == ''){
			$list = $this->Schedulemodel->selectjoinwhere($searchFaculty,$searchCourse,$searchSY,$searchSem);
		// }
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
				  <button class="dropdown-item" onclick="edit('.$record->class_id.');">Edit</button>
				  <button class="dropdown-item" onclick="deleteBtn('.$record->class_id.');" >Delete</button>
				</div>
			  </div>';
			$row[] = $record->subj_code;
			$row[] = $record->subj_name;
			$row[] = $record->suffix .' '. $record->lname .','. $record->fname .' '. $record->mname;
			$row[] = $record->day1 . $record->day2 . $record->day3 . $record->day4 . $record->day5 . $record->day6;
			$row[] = $record->time_start.' - '.$record->time_end;
			$row[] = $record->room_name;

			$row[] = $button;
			$data[] = $row;
		}
		$output = array (
			"data" => $data
		);
		echo json_encode($data);
	}

	function fetch_singledata(){
		$table = 'tbl_class';
		$where = 'class_id';
		$id =  $this->input->post('idd');
		//* CRUD MODEL*//
		$data = $this->Globalmodel->fetch_single_data($id,$table,$where);
		//* CRUD MODEL*//
		echo json_encode($data);
	}
	function delete_data(){
		$table = 'tbl_class';
		$where = 'class_id';
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

