 <?php
class model_member extends CI_Model {

	function dbPull() {
		$query = $this->db->query('SELECT * from registrations_master');
		$array = $query->result();
		return json_encode($array);
	}

	function getData() {
		$query = $this->db->query("SELECT * from 'registrations_master'");
		return json_encode($query->result());
	}

	function dbPullChildren($key) {
		$this->db->select("*");
		$this->db->from("registrations_details");
		$this->db->where("registration_id", $key);
		$query = $this->db->get();
		$array = $query->result();
		return json_encode($array);
	}

	function dbPullChildrenMedical($key) {
		$this->db->select("*");
		$this->db->from("medical_conditions_details");
		$this->db->where("member_id", $key);
		$query = $this->db->get();
		$array = $query->result();
		return json_encode($array);
	}

	function dbUpdateParent($key, $array) {
		$this->db->where('registration_id', $key);
		$this->db->update('registrations_master', $array);
		$this->db->select("*");
		$this->db->from("registrations_master");
		$this->db->where("registration_id",$key);
		$result = $this->db->get();
		return json_encode($result->result());
	}

	function dbUpdateChild($key, $array, $medical, $skill) {
		$this->db->where('member_id', $key);
		$this->db->update('registrations_details', $array);
		$this->db->select("*");
		$this->db->from("registrations_details");
		$this->db->where("member_id",$key);
		$query = $this->db->get();
		$array = $query->result();
		
		$this->db->where("member_id", $key);
		$this->db->delete('medical_conditions_details');

		if ($medical!="")
		foreach($medical as $value) {
			$this->db->set('member_id', $key);
			$this->db->set('medical_condition_id', $value);				
			$this->db->insert('medical_conditions_details');		
		}
		
		$this->dbUpdateMemberSkills($skill, $key);
		
		return json_encode($array);
	}

	function dbAddParent($array) {
		$this->db->insert('registrations_master', $array);
	}

	function db_add_child($array, $medical, $skill) {
		$this->db->insert('registrations_details', $array);			
		$key = $this->db->insert_id();		

		if ($medical != 'null') {
			foreach($medical as $id => $value) {
				$this->db->set('member_id', $key);
				$this->db->set('medical_condition_id', $id);				
				$this->db->insert('medical_conditions_details');
			}
		}
		
		foreach ($skill as $id => $value ){
			$skill[$id]['member_id'] = $key;
		}
		
		$this->dbUpdateMemberSkills($skill);
		
	}

	
	private function dbUpdateMemberSkills($skill){
		foreach ($skill as $id => $row){
			$this->db->delete('members_skills', array('member_id' => $row['member_id'], 'sport_id' => $id));
			if ($row['skill_id']!='null'){
				$this->db->insert('members_skills', array(
					'member_id' => $row['member_id'],
					'sport_id' => $id,
					'skill_id' => $row['skill_id'],
					'number_lessons' => $row['number_lessons']
				));
			}
		}
	}
	
	function dbGetMemberProgressList($child, $term){
		$string='';
		$this->db->select('mp.progress_id, s.sport_description, sd.schedule_date, gm.group_name, sm.skill_band, mp.attendance');
		$this->db->from("schedule_details sd, groups_master gm, skills_master sm, members_progress mp, sports s");
		$this->db->where('mp.member_id', $child);
		$this->db->where('gm.term_id', $term);
		$this->db->where('sd.group_id = gm.group_id and mp.schedule_id = sd.schedule_id and gm.skill_id = sm.skill_id and sm.sport_id = s.sport_id');
		$query=$this->db->get();
		foreach ($query->result() as $row){
			$string.='<tr data-value="'.$row->progress_id.'"><td>'.$row->schedule_date.'</td><td>'.$row->sport_description.'</td><td>'.$row->group_name.'</td>
			<td>'.$row->skill_band.'</td>';
			if ($row->attendance=='1')
				$string.='<td>Yes</td></tr>';
			else
				$string.='<td>No</td></tr>';
		}
		return $string;
		
	}
	
	function db_check_parent($regId){
		$this->db->select("*");
		$this->db->from("registrations_details");
		$this->db->where("registration_id", $regId);
		$query=$this->db->get();
		return $query->num_rows();			
	}
	
	function db_delete_parent($regId){
		$this->db->delete('registrations_master', array('registration_id' => $regId)); 					
	}
	
	function db_check_child($memId){
		$this->db->select("*");
		$this->db->from("members_progress");
		$this->db->where("member_id", $memId);
		$numProg=$this->db->get()->num_rows();
		$this->db->select("*");
		$this->db->from("groups_details");
		$this->db->where("member_id", $memId);
		$numGroup=$this->db->get()->num_rows();
		$this->db->select("*");
		$this->db->from("payments_master");
		$this->db->where("member_id", $memId);
		$numPayment=$this->db->get()->num_rows();
		if ($numProg>0 || $numGroup>0 || $numPayment>0)
			return 0;
		else
			return 1;
	}
	
	function db_delete_child($memId){
		$this->db->delete('registrations_details', array('member_id' => $memId)); 					
	}
}

?>
