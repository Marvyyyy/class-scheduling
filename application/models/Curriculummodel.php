<?php

class Curriculummodel extends CI_Model
{
	function selectjoin() {
		
		// $this->db->select('tbl_class.class_id,tbl_faculty.faculty_id,tbl_subject.subj_code');
		// $this->db->from('tbl_class');
		// $this->db->where('tbl_class.class_id != 0');
		// $this->db->join('tbl_faculty','tbl_faculty.id = tbl_class.faculty_id','left');
		// $this->db->join('tbl_subject','tbl_subject.subj_id = tbl_class.subj_code','left');
		$query = "SELECT tbl_class.class_id,tbl_course.crs_description,tbl_schoolyear.sy_name,tbl_semester.sem_description,tbl_subject.subj_code,
		tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.lname,tbl_faculty.suffix,
		tbl_class.day1,tbl_class.day2,tbl_class.day3,tbl_class.day4,tbl_class.day5,tbl_class.day6,
		tbl_class.time_start,tbl_class.time_end,tbl_class.semester,tbl_class.school_yr,tbl_class.course_id,tbl_subject.subj_name,tbl_room.room_name,tbl_class.faculty_id FROM `tbl_class` LEFT JOIN tbl_course ON tbl_class.course_id=tbl_course.crs_id LEFT JOIN tbl_schoolyear ON tbl_class.school_yr=tbl_schoolyear.id LEFT JOIN tbl_semester on tbl_class.semester=tbl_semester.sem_id LEFT JOIN tbl_subject ON tbl_class.subj_code=tbl_subject.subj_id LEFT JOIN tbl_faculty on tbl_faculty.id=tbl_class.faculty_id LEFT JOIN tbl_room on tbl_room.room_id=tbl_class.room_id";
		$rs = $this->db->query($query);
		return $rs->result_array();
	}
	// function selectjoinwherecourse($searchsyType,$searchsemType) {
		
	// 	// $this->db->select('tbl_class.class_id,tbl_faculty.faculty_id,tbl_subject.subj_code');
	// 	// $this->db->from('tbl_class');
	// 	// $this->db->where('tbl_class.class_id != 0');
	// 	// $this->db->join('tbl_faculty','tbl_faculty.id = tbl_class.faculty_id','left');
	// 	// $this->db->join('tbl_subject','tbl_subject.subj_id = tbl_class.subj_code','left');
	// 	$query = "SELECT tbl_class.class_id,tbl_course.crs_description,tbl_schoolyear.sy_name,tbl_semester.sem_description,tbl_subject.subj_code,
	// 	tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.lname,tbl_faculty.suffix,
	// 	tbl_class.day1,tbl_class.day2,tbl_class.day3,tbl_class.day4,tbl_class.day5,tbl_class.day6,
	// 	tbl_class.time_start,tbl_class.time_end,tbl_class.semester,tbl_class.school_yr
	// 	FROM `tbl_class`
	// 	LEFT JOIN tbl_course ON tbl_class.course_id=tbl_course.crs_id
	// 	LEFT JOIN tbl_schoolyear ON tbl_class.school_yr=tbl_schoolyear.id
	// 	LEFT JOIN tbl_semester on tbl_class.semester=tbl_semester.sem_id
	// 	LEFT JOIN tbl_subject ON tbl_class.subj_code=tbl_subject.subj_id
	// 	LEFT JOIN tbl_faculty on tbl_faculty.id=tbl_class.faculty_id WHERE tbl_class.school_yr='.$searchsyType.' and tbl_class.semester='.$searchsemType.'";
	// 	$rs = $this->db->query($query);
	// 	return $rs->result_array();
	// }
	

	
}

?>
