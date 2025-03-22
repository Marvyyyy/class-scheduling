<?php

class Globalmodel extends CI_Model
{
	function insert_data($data,$table){
        $result=$this->db->insert($table,$data);
		
        return $result;
	}

	function fetch_alldata($table) {
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_single_data($id,$table,$where) {
		$this->db->where($where, $id);
		$this->db->from($table);
		$query = $this->db->get();
		return $query->row_array();
	}

	function fetch_single_data_join($id,$table,$where,$joinfrom,$join,$jointype) {
		$this->db->from($table);
		$this->db->where($where, $id);
		$this->db->join($joinfrom,$join,$jointype);
		$query = $this->db->get();
		return $query->row_array();
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
	function selectjoin($select,$table,$joinfrom,$join,$jointype) {
		
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($joinfrom,$join,$jointype);
		$query = $this->db->get();
		return $query->result();
	}
	function selectjoinwhere($select,$table,$where,$joinfrom,$join,$jointype) {
		
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->join($joinfrom,$join,$jointype);
		$query = $this->db->get();
		return $query->result();
	}
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
	
	function selectjoinwherefecthfaculty($select,$table,$where,$where2,$joinfrom,$join,$jointype,$joinfrom2,$join2,$jointype2,$joinfrom3,$join3,$jointype3) {
		
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->or_where($where2);
		$this->db->join($joinfrom,$join,$jointype);
		$this->db->join($joinfrom2,$join2,$jointype2);
		$this->db->join($joinfrom3,$join3,$jointype3);
		$query = $this->db->get();
		return $query->result();
	}
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
		  if ( $query->num_rows() > 0 )
		{
			$data =  $query->result_array();
			return $data;
		}
		else
		{
			return FALSE;
		}
	}
	function select($select,$table) {
		$this->db->select($select);
		$this->db->from($table);
        $query=$this->db->get();
        $data =  $query->result_array();
        return $data;
	}

	public function count_all($table)
	{
		$this->db->select('*');
        $this->db->from($table);
		return $this->db->count_all_results();
	}
	

	
}

?>
