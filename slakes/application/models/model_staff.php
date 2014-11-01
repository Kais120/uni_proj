<?php 
	class model_staff extends CI_Model{		
		
		public function dbPullData(){			
			$query=$this->db->get("staff");
			return $query->result();
		}
		
		public function dbPullDetails($staffId){
			$this->db->select("staff.*, users.username, users.type");
			$this->db->from("staff, users");	
			$this->db->where("users.staff_id = staff.staff_id");
			$this->db->where("staff.staff_id", $staffId);
			$query = $this->db->get();
			return json_encode($query->result());
		}
				
		public function db_pull_profile($staffId){
			$this->db->select("staff.*, users.username, users.question, users.answer");
			$this->db->from("staff, users");			
			$this->db->where("staff.staff_id", $staffId);
			$this->db->where("users.staff_id = staff.staff_id");
			$query = $this->db->get();
			return $query->row();
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
		
		function db_save_profile($staffId, $staff, $user){
			$this->db->where("staff_id", $staffId);
			$this->db->update("staff", $staff);
			$this->db->where("staff_id", $staffId);
			$this->db->update("users", $user);			
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
		
		public function dbGetStaffOptions($groupId){
			$string = '';
			$staffId = 0;
			$this->db->select('staff_id');
			$this->db->from("schedule_master");	
			$this->db->where('group_id', $groupId);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$staffId = $query->row()->staff_id;
			}
			$this->db->select('staff_id, staff_fname, staff_lname');
			$this->db->from("staff");	
			$this->db->where('active', 1);
			$result = $this->db->get()->result();
			foreach ($result as $row){
				if ($row->staff_id == $staffId)
					$string.='<option value="'.$row->staff_id.'" selected>'.$row->staff_fname.' '.$row->staff_lname.'</option>';
				else
					$string.='<option value="'.$row->staff_id.'">'.$row->staff_fname.' '.$row->staff_lname.'</option>';
			}
			return $string;
		}		
		
	}

?>