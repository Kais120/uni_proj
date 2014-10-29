<?php
class model_user extends CI_Model
{
	function login($username, $password){
		
		$this->db->select('staff_id, username, password');
		$this->db->from('users');
		$this->db->where('username', $username);		
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
			$this->db->select("question");
			$this->db->from("users");
			$this->db->where("username",$username);
			$query = $this->db->get();
						
			if ($query->num_rows()>0)
				$question=$query->row()->question;
			
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
		}	
		$this->load->library('encrypt');
		$result=$this->encrypt->decode("$pass");
		return $result;
	}
}
?>