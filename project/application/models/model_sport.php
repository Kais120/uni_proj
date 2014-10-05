 <?php
class model_sport extends CI_Model {

	function dbPullData($sport) {
		$this->db->select("skill_id, skill_band, skill_band_description");
		$this->db->from("skills_master");
		$this->db->where("sport_id", $sport);
		$this->db->order_by("skill_id");
		$query = $this->db->get();
		return json_encode($query->result());
	}

	function dbGetTasks($skill) {
		$this->db->select("task_id, task, task_description");
		$this->db->from("skills_details");
		$this->db->where("skill_id", $skill);
		$this->db->order_by("task_id");
		$query = $this->db->get();
		return json_encode($query->result());
	}

	function dbUpdateSkill($skill, $array) {
		$this->db->where("skill_id", $skill);
		$this->db->update('skills_master', $array);
		$this->db->select("skill_band, skill_band_description");
		$this->db->from("skills_master");
		$this->db->where("skill_id", $skill);
		$query = $this->db->get();
		return json_encode($query->result());
	}

	function dbUpdateTask($task, $array) {
		$this->db->where("task_id", $task);
		$this->db->update('skills_details', $array);
		$this->db->select("task, task_description");
		$this->db->from("skills_details");
		$this->db->where("task_id", $task);
		$query = $this->db->get();
		return json_encode($query->result());
	}

	function dbAddSkill($array) {
		$this->db->insert('skills_master', $array);
	}

	function dbAddTask($array) {
		$this->db->insert('skills_details', $array);
	}

	function dbPullSports() {
		$this->db->select("sport_id, sport_description");
		$this->db->from("sports");
		$query = $this->db->get();
		return $query->result();
	}

	function dbGetLessons($sportId) {
		$this->db->select("lesson_id, lesson_description, cost");
		$this->db->from("lessons");
		$this->db->where("sport_id", $sportId);
		$query = $this->db->get();
		return json_encode($query->result());
	}

	function dbUpdateLesson($array, $lessonId) {
		$this->db->where("lesson_id", $lessonId);
		$this->db->update('lessons', $array);
	}

	function dbAddLesson($array, $sport) {
		switch (strtolower($sport)) {
		case 'tennis':
			$array['sport_id'] = 1;
			break;
		case 'swimming':
			$array['sport_id'] = 2;
			break;
		}

		$this->db->insert('lessons', $array);
	}

	function dbGetSkillLevels() {
		$this->db->select('sport_id, skill_id, skill_band');
		$this->db->from("skills_master");
		return json_encode($this->db->get()->result());
	}
	
	function dbGetChildLevels($memberId) {
		$this->db->select('sport_id, skill_id, number_lessons');
		$this->db->from('members_skills');
		$this->db->where('member_id', $memberId);
		return json_encode($this->db->get()->result());
	}
	
	function dbGetSchedule($sportId,$start,$end){
		$events = array();
		$item = array(
			'id' => '',
			'title' => '',
			'start' => '',
			'end' => ''
		);
		$this->db->select('sd.schedule_id, gm.group_name, skm.skill_band, sd.schedule_date, sd.start_time, sd.end_time');
		$this->db->from('groups_master gm, schedule_details sd, schedule_master sm, skills_master skm');
		$this->db->where('sm.group_id = gm.group_id and sd.group_id = sm.group_id and gm.skill_id = skm.skill_id');
		$this->db->where('sd.schedule_date >=', $start);
		$this->db->where('sd.schedule_date <=', $end);
		//$this->db->where('skm.sport_id', $sportId);
		$query = $this->db->get();
		foreach ($query->result() as $row){
			$item['id'] =  $row-> schedule_id;
			$item['title'] =  $row->group_name.' '.$row->skill_band;
			$item['start'] =  $row->schedule_date.'T'.$row->start_time;
			$item['end'] = $row->schedule_date.'T'.$row->end_time;
			$events[]=$item;
		}
		
		return json_encode($events);
	}
}
?>

