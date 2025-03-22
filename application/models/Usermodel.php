<?php

class Usermodel extends CI_Model
{
	function insert_data($data,$tbl_name){
        $result=$this->db->insert($tbl_name,$data);
		
        return $result;
	}

	function fetch_alldata($table) {
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		return $query->result();
	}
	function selectjoin($table,$joinfrom,$join,$jointype) {
		
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($joinfrom,$join,$jointype);
		$query = $this->db->get();
		return $query->result();
	}
	public function checkUser($username,$password){
		$pass = md5($password);
		$sql = "SELECT * FROM tbl_users LEFT JOIN role ON role.role_id = tbl_users.role LEFT JOIN tbl_faculty ON tbl_faculty.id = tbl_users.profile_id WHERE tbl_users.username='$username' AND tbl_users.password='$pass'";
		$query = $this->db->query($sql);
		$rows = $query->num_rows();
		if($rows == 1){
		   $user_id = $query->row()->id;
		   $username = $query->row()->username;
		   $lastname = $query->row()->lname;
		   $firstname = $query->row()->fname;
		   $middlename = $query->row()->mname;
		   $accesslevel = $query->row()->role;
		   $rolename = $query->row()->role_name;
		   $profile_id = $query->row()->profile_id;
		   $newdata = array(
			  'user_id'  => $user_id,
			  'username'  => $username,
			  'password'  => $password,
			  'lastname'  => $lastname,
			  'firstname'  => $firstname,
			  'middlename'  => $middlename,
			  'accesslevel'  => $accesslevel,
			  'rolename'  => $rolename,
			  'profile_id' => $profile_id,
			  'logged_backend' => TRUE,
		   );
		  
		   $this->session->set_userdata($newdata);
		   if($accesslevel == "3"){
			  $data["response"] = "event";
		   }else{
			  $data["response"] = "admin";
		   }
		   
		   print json_encode($data);
		}
		else{
		   $data["response"] = "Incorrect username or password. Please try again.";
		   print json_encode($data);
		}
		
	 }

	// function fetch_single_data($id,$tbl_name,$field_name) {
	// 	$this->db->where($field_name, $id);
	// 	$this->db->from($tbl_name);
	// 	$query = $this->db->get();
	// 	return $query->row_array();
	// }

	// function update_data($data,$tbl_name,$field_name,$id) {
		
	// 	$this->db->set($data);
	// 	$this->db->where($field_name, $id);
	// 	$this->db->update($tbl_name,);
	// }

	// function delete_data($id,$tbl_name,$field_name) {
	// 	$this->db->where($field_name, $id);
	// 	$this->db->delete($tbl_name);

	// }

	// /////////////////////////////////
	// public function selectwhere($table,$where){
	// 	$this->db->select('*');
	// 	$this->db->from($table);
	// 	$this->db->where($where);
	// 	  $query = $this->db->get();
	// 	  $data =  $query->result_array();
	// 	  return $data;
	//  }
	

	
}

?>
