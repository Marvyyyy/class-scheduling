<?php

class StudentModel extends CI_Model
{
	function selectjoin() {
		
		// $this->db->select('tbl_class.class_id,tbl_faculty.faculty_id,tbl_subject.subj_code');
		// $this->db->from('tbl_class');
		// $this->db->where('tbl_class.class_id != 0');
		// $this->db->join('tbl_faculty','tbl_faculty.id = tbl_class.faculty_id','left');
		// $this->db->join('tbl_subject','tbl_subject.subj_id = tbl_class.subj_code','left');
		$query = "SELECT tbl_class.*,tbl_schoolyear.* FROM `tbl_class` LEFT JOIN tbl_schoolyear ON tbl_class.school_yr=tbl_schoolyear.id  GROUP BY tbl_class.school_yr";
		$rs = $this->db->query($query);
		return $rs->result_array();
	}
 
    function get_sub_category1($category_id){
       $this->db->get_where('tbl_class', array('school_yr' => $category_id));
		$query = "SELECT tbl_class.semester,tbl_semester.sem_id,tbl_semester.sem_description FROM `tbl_class` LEFT JOIN tbl_semester on tbl_class.semester=tbl_semester.sem_id GROUP BY tbl_class.semester";
        $rs = $this->db->query($query);
		return $rs->result();
    }

	function get_sub_category2($category_id){
		$this->db->get_where('tbl_class', array('semester' => $category_id));
		 $query = "SELECT tbl_class.course_id,tbl_course.crs_id,tbl_course.crs_title,tbl_course.crs_major FROM `tbl_class` LEFT JOIN tbl_course on tbl_class.course_id=tbl_course.crs_id GROUP BY tbl_course.crs_id";
		 $rs = $this->db->query($query);
		 return $rs->result();
	 }
	function getClass($sy_name,$semester,$course,$section) {
		
		// $this->db->select('tbl_class.class_id,tbl_faculty.faculty_id,tbl_subject.subj_code');
		// $this->db->from('tbl_class');
		// $this->db->where('tbl_class.class_id != 0');
		// $this->db->join('tbl_faculty','tbl_faculty.id = tbl_class.faculty_id','left');
		// $this->db->join('tbl_subject','tbl_subject.subj_id = tbl_class.subj_code','left');
		$query = "SELECT tbl_class.class_id FROM `tbl_class` WHERE tbl_class.school_yr=$sy_name AND tbl_class.semester=$semester AND tbl_class.course_id=$course AND tbl_class.section=$section";
		$rs = $this->db->query($query);
		return $rs->result();
	}
	function gettAllStudents() {
		$query = "SELECT tbl_students.id,tbl_students.student_id,tbl_students.lname,tbl_students.mname,tbl_students.fname,tbl_course.crs_title,tbl_course.crs_major FROM `tbl_students` INNER JOIN tbl_enroll ON tbl_enroll.student_id=tbl_students.id INNER JOIN tbl_class ON tbl_class.class_id=tbl_enroll.class_id INNER JOIN tbl_course ON tbl_course.crs_id=tbl_class.course_id GROUP BY tbl_students.id";
		$rs = $this->db->query($query);
		return $rs->result();
	}

	
}

?>
