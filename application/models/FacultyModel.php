<?php

class FacultyModel extends CI_Model
{
	function insert_data($data,$table){
        $result=$this->db->insert($table,$data);
        return $result;
	}
	function insert_data_batch($data,$table){
        $result=$this->db->insert_batch($table,$data);
        return $result;
	}

	// function fetch_alldata($table) {
	// 	$this->db->select('*');
	// 	$this->db->from($table);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	function fetch_single_data($id,$table,$where) {
		$this->db->where($where, $id);
		$this->db->from($table);
		$query = $this->db->get();
		return $query->row_array();
	}

	// function fetch_single_data_join($id,$table,$where,$joinfrom,$join,$jointype) {
	// 	$this->db->from($table);
	// 	$this->db->where($where, $id);
	// 	$this->db->join($joinfrom,$join,$jointype);
	// 	$query = $this->db->get();
	// 	return $query->row_array();
	// }
	function fetch_single_data_join($id) {
        $this->db->select('tbl_faculty.id as fac_id,tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.lname,tbl_faculty.suffix,tbl_faculty.faculty_id,tbl_users.role');
        $this->db->from('tbl_faculty');
        // $this->db->join('tbl_specialization', 'tbl_faculty.id=tbl_specialization.faculty_id');
        // $this->db->join('tbl_subject', 'tbl_specialization.subj_code=tbl_subject.subj_id');
        $this->db->join('tbl_users', 'tbl_faculty.id=tbl_users.profile_id');
        $this->db->where('tbl_faculty.id',$id);
		// $query = $this->db->get();
		// return $query->row_array();
		$query = $this->db->get();
		return $query->row_array();
	}
	function fetch_single_data_join2($id) {
        $this->db->where('tbl_specialization.faculty_id',$id);
        // $this->db->select('tbl_subject.subj_id,tbl_subject.subj_code');
        $this->db->from('tbl_specialization');
        $this->db->join('tbl_subject', 'tbl_specialization.subj_code=tbl_subject.subj_id');
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
			// return $query->result();
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}
	function update_data($data,$table,$where,$id) {
		
		$this->db->set($data);
		$this->db->where($where, $id);
		$this->db->update($table,);
	}

	function delete_data($id,$table,$where) {
		$this->db->where($where, $id);
		$this->db->delete($table);

	}

	// /////////////////////////////////
	// function selectjoin($select,$table,$joinfrom,$join,$jointype) {
		
	// 	$this->db->select($select);
	// 	$this->db->from($table);
	// 	$this->db->join($joinfrom,$join,$jointype);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	// function selectjoinwhere($select,$table,$where,$joinfrom,$join,$jointype) {
		
	// 	$this->db->select($select);
	// 	$this->db->from($table);
	// 	$this->db->where($where);
	// 	$this->db->join($joinfrom,$join,$jointype);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	function selectjoinwherefaculty($select,$table,$where,$where2,$where3,$joinfrom,$join,$jointype,$joinfrom2,$join2,$jointype2,$joinfrom3,$join3,$jointype3) {
		
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->or_where($where2);
		$this->db->where($where3);
		$this->db->join($joinfrom,$join,$jointype);
		$this->db->join($joinfrom2,$join2,$jointype2);
		$this->db->join($joinfrom3,$join3,$jointype3);
		$query = $this->db->get();
		return $query->result();
	}
	function selectjoinwherefaculty2() {
		
		$query = "SELECT tbl_faculty.id as id,tbl_users.id as user_id,tbl_users.username,tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.lname,tbl_faculty.suffix,role.role_name,tbl_users.is_deleted,tbl_subject.subj_code,GROUP_CONCAT(tbl_subject.subj_code) AS subj_code
		FROM tbl_users INNER JOIN tbl_faculty ON tbl_users.profile_id=tbl_faculty.id 
		JOIN role ON tbl_users.role=role.id
		left JOIN tbl_specialization ON tbl_faculty.id=tbl_specialization.faculty_id
		LEFT JOIN tbl_subject on tbl_specialization.subj_code=tbl_subject.subj_id
		WHERE ((tbl_users.role=3) OR (tbl_users.role=4)) AND (tbl_users.is_deleted=0)
		GROUP BY tbl_faculty.id";
		$rs = $this->db->query($query);
		return $rs->result();
	}
	function faculty_spec() {
		
		$query = "SELECT subj_code FROM `tbl_specialization` WHERE tbl_specialization.faculty_id=1";
		$rs = $this->db->query($query);
		return $rs->result();
	}
	// function selectjoinwherefaculty() {
		
	// 	// $this->db->select('*');
	// 	// $this->db->from('tbl_users');
	// 	// $this->db->where('tbl_users.role = 3 ');
	// 	// $this->db->or_where('tbl_users.role = 4 ');
	// 	// $this->db->where('tbl_users.is_deleted = 0 ');
	// 	// $this->db->join('tbl_faculty','tbl_faculty.id = tbl_users.profile_id','intersect');
	// 	// $this->db->join('tbl_specialization','tbl_specialization.specialization_id = tbl_faculty.spec_code','left');
	// 	// $this->db->join('role','role.role_id = tbl_users.role','left');
	// 	// $this->db->union('role','role.role_id = tbl_users.role','left');
	// 	$this->db-('SELECT * FROM tbl_users INNER JOIN tbl_faculty ON tbl_users.profile_id=tbl_faculty.id JOIN role ON tbl_users.role=role.id LEFT JOIN tbl_faculty_spec ON tbl_faculty.id=tbl_faculty_spec.faculty_id LEFT JOIN tbl_specialization ON tbl_faculty_spec.spec_code=tbl_specialization.specialization_id WHERE (tbl_users.role=3 OR tbl_users.role=4) AND (tbl_users.is_deleted=0)');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	
	// function selectjoinwherefecthfaculty($select,$table,$where,$where2,$joinfrom,$join,$jointype,$joinfrom2,$join2,$jointype2,$joinfrom3,$join3,$jointype3) {
		
	// 	$this->db->select($select);
	// 	$this->db->from($table);
	// 	$this->db->where($where);
	// 	$this->db->or_where($where2);
	// 	$this->db->join($joinfrom,$join,$jointype);
	// 	$this->db->join($joinfrom2,$join2,$jointype2);
	// 	$this->db->join($joinfrom3,$join3,$jointype3);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	public function selectwhere($select,$table,$where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		  $query = $this->db->get();
		  $data =  $query->result();
		  return $data;
	}
	public function selectwherearray($select,$table,$where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		  $query = $this->db->get();
		  $data =  $query->result_array();
		  return $data;
	}
	function select($select,$table) {
		$this->db->select($select);
		$this->db->from($table);
        $query=$this->db->get();
        $data =  $query->result_array();
        return $data;
	}
	

	
}

?>
