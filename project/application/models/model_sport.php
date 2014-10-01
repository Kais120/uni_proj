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
		
		function dbPullSports(){
			$this->db->select("sport_id, sport_description");
			$this->db->from("sports");
			$query=$this->db->get();
			return $query->result();
		}
		
		function dbGetLessons($sportId){
			$this->db->select("lesson_id, lesson_description, cost");
			$this->db->from("lessons");
			$this->db->where("sport_id", $sportId);
			$query=$this->db->get();
			return json_encode($query->result());
		}
		
		function dbUpdateLesson($array, $lessonId){
			$this->db->where("lesson_id", $lessonId);
			$this->db->update('lessons', $array);
		}
		
		function dbAddLesson($array, $sport){
			switch (strtolower($sport)){
				case 'tennis':
					$array['sport_id'] = 1;
					break;
				case 'swimming':
					$array['sport_id'] = 2;
					break;
			}
			
			$this->db->insert('lessons',$array);
			
		}
	}

?>