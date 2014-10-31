<?php
class model_user extends CI_Model
{
	function login($username, $password){
		
		$this->db->select('users.staff_id, users.username, users.password');
		$this->db->from('users, staff');
		$this->db->where('staff.staff_id = users.staff_id');
		$this->db->where('staff.active',1);
		$this->db->where('users.username', $username);		
		$this->db->limit(1); 
		$query = $this->db->get(); 
		
		if($query->num_rows() == 1)
		{
			$this->load->library('encrypt');
			$decPass = $this->encrypt->decode($query->row()->password);
			if ($decPass==$password)
				return $query->result();
			else
				return false;
		}
		else
		{
			return false;
		}
	}
	
	function db_get_account_type($id){
		$this->db->select('type');
		$this->db->from('users');
		$this->db->where('staff_id',$id);
		return $this->db->get()->row()->type;
	}
	
	function db_find_question($username){
			$question="none";
			$this->db->select("question, answer");
			$this->db->from("users");
			$this->db->where("username",$username);
			$query = $this->db->get();
						
			if ($query->num_rows()>0){
				if (is_null($question=$query->row()->answer))
					return $question;
				$question=$query->row()->question;
			}
			
			return $question;
		}
		
	function db_get_result($username, $answer){		
		$result=false;
		$pass="";
		$this->db->select("answer");
		$this->db->from("users");
		$this->db->where("username",$username);	
		$reply = $this->db->get()->row()->answer;
		if (strcmp($answer, $reply) == 0){			
			$this->db->select("password");
			$this->db->from("users");
			$this->db->where("username",$username);
			$query = $this->db->get();			
			$pass = $query->row()->password;
			$this->unlock($username);
			$this->load->library('encrypt');
			$result=$this->encrypt->decode("$pass");
		}	
		
		return $result;
	}
	
	private function unlock($username){
		$this->db->select("staff_id");	
		$this->db->from("users");
		$this->db->where("username",$username);
		$id = $this->db->get()->row()->staff_id;
		$this->db->where('staff_id', $id);
		$this->db->update('staff', array('active'=>1)); 
	}
}
?>