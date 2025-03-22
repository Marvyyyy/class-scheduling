<?php
date_default_timezone_set("Asia/manila");
class Datatablesmodel extends CI_Model {

   function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->helper('cookie');
      $this->load->library('session');
	}

	private function _get_datatables_query($table,$where,$select,$join,$column_order,$column_search,$ordering)
	{
        $this->db->select($select);
        $this->db->from($table);
        //join 
        if (!empty($join)) {
            foreach ($join as $join) {
                if ($join['join_type'] == '') {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }
        $this->db->where($where);
        

		$i = 0;
	
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($ordering))
		{
			if($table == "inquiry"){
				$this->db->order_by('inquiry.identifier_code', 'desc');
				$this->db->order_by('inquiry.id', 'desc');
			}else if($table == "payment_trail"){
				$this->db->order_by('notify', 'desc');
				$this->db->order_by('id', 'desc');
				if($this->uri->segment(3) == 1){
					$this->db->limit(5);
				}
			}
			elseif ($table == "members_trail") {
				$this->db->group_by('datetime');
				//$this->db->order_by('datetime','DESC');
			}
			else{
				$order = $ordering;
				$this->db->order_by(key($order), $order[key($order)]);
			}
			
		}
	}

	function get_datatables($table,$where,$select,$join,$column_order,$column_search,$ordering)
	{
		$this->_get_datatables_query($table,$where,$select,$join,$column_order,$column_search,$ordering);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($table,$where,$select,$join,$column_order,$column_search,$ordering)
	{
      $this->_get_datatables_query($table,$where,$select,$join,$column_order,$column_search,$ordering);
		$query = $this->db->get();		
		return $query->num_rows();
		
	}

	public function count_all($table,$where,$select,$join,$column_order,$column_search,$ordering)
	{

		if ($table == "members_trail") {
			$this->db->select($select);
         $this->db->from($table);
			$this->db->group_by('datetime');
				//$this->db->order_by('datetime','DESC');
		}else {
			$this->db->from($table);
		}
        
        //join 
        if (!empty($join)) {
            foreach ($join as $join) {
                if ($join['join_type'] == '') {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }
		  
		if($table == "manager" || $table == "documents" || $table == "pre_event_attendance" || $table == "event_attendance"){
			$this->db->where($where);
		}
		elseif ($table == "members") {
			$this->db->where($where);
		}
		
		
		        
		return $this->db->count_all_results();
	}

}
