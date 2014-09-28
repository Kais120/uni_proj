<?php 
	class model_member extends CI_Model{		
		
		function dbPull(){
			$query = $this->db->query('SELECT * from registrations_master');		
			$array = $query->result();		
			return json_encode($array);					
		}
	
		function getData(){
			$query = $this->db->query("SELECT * from 'registrations_master'");
			return json_encode($query->result());
		}	
		
		function dbPullChildren($key){	
			$this->db->select("*");
			$this->db->from("registrations_details");
			$this->db->where("registration_id",$key);
			$query = $this->db->get();		
			$array = $query->result();		
			return json_encode($array);					
		}	
		
		function dbPullChildrenMedical($key){	
			$this->db->select("*");
			$this->db->from("medical_conditions_details");
			$this->db->where("member_id",$key);
			$query = $this->db->get();		
			$array = $query->result();		
			return json_encode($array);					
		}	
		
		function dbUpdateParent($key, $array){
			$this->db->where('registration_id', $key);
			$this->db->update('registrations_master', $array);
			$query = $this->db->query('SELECT * from registrations_master where registration_id ='.$key);
			$array = $query->result();
			return json_encode($array);	
		}
		
		function dbUpdateChild($key, $array, $medical){
			$this->db->where('member_id', $key);
			$this->db->update('registrations_details', $array);	
			$query = $this->db->query('SELECT * from registrations_details where member_id ='.$key);
			$array = $query->result();
			
			if ($medical!='null')
			{
				$this->db->where('member_id', $key);
				$this->db->delete('medical_conditions_details'); 
				
				foreach ($medical as $id => $value){
					$this->db->set('member_id', $key);
					$this->db->set('medical_condition_id', $id);
					$this->db->set('medical_condition_description', 'none');	
					$this->db->insert('medical_conditions_details');
				}
			}
			return json_encode($array);	
		}
		
		function dbAddParent ($array){
			$this->db->insert('registrations_master', $array);
		}
		
		function dbAddChild ($array, $medical){
			$this->db->insert('registrations_details', $array);
			$this->db->select('member_id');
			$this->db->from('registrations_details');
			$this->db->where('registration_id',$array['registration_id']);
			$this->db->where('member_fname',$array['member_fname']);
			$this->db->where('member_mname',$array['member_mname']);
			$this->db->where('member_lname',$array['member_lname']);
			$this->db->where('member_dob',$array['member_dob']);			
			$query = $this->db->get();
			$result = $query->result();
			
			foreach($result as $row){
				$key = $row->member_id;
			}
			
			if ($medical!='null')
			{	
				foreach ($medical as $id => $value){
					$this->db->set('member_id', $key);
					$this->db->set('medical_condition_id', $id);
					$this->db->set('medical_condition_description', 'none');	
					$this->db->insert('medical_conditions_details');
				}
			}
		}
	}

?>