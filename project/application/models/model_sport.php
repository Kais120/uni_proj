<?php 
	class model_sport extends CI_Model{		
		
		function dbPullData($sport){			
			$this->db->select("skill_id, skill_band, skill_band_description");
			$this->db->from("skills_master");
			$this->db->where("sport_id", $sport);
			$this->db->order_by("skill_id");
			$query = $this->db->get();
			return json_encode($query->result());			
		}	
		
		function dbGetTasks($skill){			
			$this->db->select("task_id, task, task_description");
			$this->db->from("skills_details");
			$this->db->where("skill_id", $skill);
			$this->db->order_by("task_id");
			$query = $this->db->get();
			return json_encode($query->result());			
		}
		
		function dbUpdateSkill($skill, $array){
			$this->db->where("skill_id", $skill);
			$this->db->update('skills_master', $array);
			$this->db->select("skill_band, skill_band_description");
			$this->db->from("skills_master");
			$this->db->where("skill_id", $skill);
			$query = $this->db->get();
			return json_encode($query->result());	
		}
		
		function dbUpdateTask($task, $array){
			$this->db->where("task_id", $task);
			$this->db->update('skills_details', $array);
			$this->db->select("task, task_description");
			$this->db->from("skills_details");
			$this->db->where("task_id", $task);
			$query = $this->db->get();
			return json_encode($query->result());	
		}
		
		function dbAddSkill($array){
			$this->db->insert('skills_master',$array);
		}
		
		function dbAddTask($array){
			$this->db->insert('skills_details',$array);
		}
	}

?>