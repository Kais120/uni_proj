<?php 
	class model_get_member_details extends CI_Model{		
		
		function db_pull(){
			$query = $this->db->query('SELECT * from registrations_master');		
			$array = $query->result();		
			return json_encode($array);					
		}
	
		function get_data(){
			$query = $this->db->query("SELECT * from 'registrations_master'");
			return json_encode($query->result());
		}	
		
		function db_pull_children($key){			
			$query = $this->db->query("SELECT * from registrations_details where registration_id ='".$key."'");		
			$array = $query->result();		
			return json_encode($array);					
		}	
		
		function db_pull_children_medical($key){			
			$query = $this->db->query("SELECT * from medical_conditions_details where member_id ='".$key."'");		
			$array = $query->result();		
			return json_encode($array);					
		}	
		
		function db_update_parent($key, $array){
			$this->db->where('registration_id', $key);
			$this->db->update('registrations_master', $array);
			$query = $this->db->query('SELECT * from registrations_master where registration_id ='.$key);
			$array = $query->result();
			return json_encode($array);	
		}
		
		function db_update_child($key, $array){
			$this->db->where('member_id', $key);
			$this->db->update('registrations_details', $array);	
			$query = $this->db->query('SELECT * from registrations_details where member_id ='.$key);
			$array = $query->result();
			return json_encode($array);	
		}
		
		function db_add_parent ($array){
			$this->db->insert('registrations_master', $array);
		}
		
		function db_add_child ($array){
			$this->db->insert('registrations_details', $array);
		}
	}

?>