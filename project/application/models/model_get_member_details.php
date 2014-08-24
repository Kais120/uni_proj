<?php 
	
	class model_get_member_details extends CI_Model{
	
		var $parents = array(
				"id"=>1,
				"FName"=>"Kaissar",
				"MName"=>"",
				"LName"=>"Shalabayev",
				"Address-1"=>"Ballarat",
				"Address-2"=>"Canadian",
				"Suburb"=>"Canadian",
				"Postcode"=>"3350",
				"email"=>"kaissar@example.com",
				"HomeNum"=>"431611980",
				"MobileNum"=>"43161980",
				"WorkNum"=>"",
				"SLR"=>true	
			);
		
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
	}

?>