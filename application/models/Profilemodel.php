<?php

class Profilemodel extends CI_Model
{
	public function selectwhereusers($table,$where){
		$this->db->select('tbl_users.*, tbl_faculty.fname,tbl_faculty.mname,tbl_faculty.faculty_id');
		$this->db->from($table);
		$query=$this->db->join('tbl_faculty', 'tbl_users.profile_id = tbl_faculty.id ', 'right');
	  //  $query=$this->db->join('documents', 'members.id = documents.member_id', 'left outer');
		//$this->db->where('documents.requirement_number','9');
	
		$this->db->where($where);
		$query = $this->db->get();
		$data =  $query->row_array();
		return $data;
	  }
	function select($select,$table) {
		$this->db->select($select);
		$this->db->from($table);
        $query=$this->db->get();
        $data =  $query->result_array();
        return $data;
	}
	public function selectwhere($select,$table,$where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		  $query = $this->db->get();
		  $data =  $query->row_array();
		  return $data;
	}
	

	
}

?>
