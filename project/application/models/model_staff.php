<?php 
	class model_staff extends CI_Model{		
		
		public function dbPullData(){			
			$query=$this->db->get("staff");
			return $query->result();
		}
		
		public function dbPullDetails($staffId){
			$this->db->select("staff.*, users.username, users.type");
			$this->db->from("staff");			
			$this->db->where("staff.staff_id", $staffId);
			$this->db->join("users","users.staff_id = staff.staff_id",'left');
			$query = $this->db->get();
			return json_encode($query->result());
		}
		
		public function dbUpdateStaff($staffId, $staff, $password, $type){
			$this->db->where("staff_id", $staffId);
			$this->db->update("staff", $staff);
			
			if ($password!='null')
				$array = array(
					'password' => $password, 
					'type' => $type
				);				
			else
				$array = array('type' => $type);
			$this->db->where("staff_id", $staffId);
			$this->db->update("users", $array);
		}
		
		public function dbAddStaff($staff, $user){
			$this->db->insert('staff',$staff);			
			$user['staff_id']=$this->db->insert_id();
			$this->db->insert('users',$user);
		}
		
		public function dbCheckUsername($username){
			$this->db->select("username");
			$this->db->from("users");
			$this->db->where("username",$username);			
			if ($this->db->count_all_results())
				return 'true';
			else
				return 'false';
		}
		
	}

?>