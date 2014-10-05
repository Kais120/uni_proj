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
		$query = $this->db->query('SELECT * from registrations_master where registration_id ='.$key);
		$array = $query->result();
		return json_encode($array);
	}

	function dbUpdateChild($key, $array, $medical, $skill) {
		$this->db->where('member_id', $key);
		$this->db->update('registrations_details', $array);
		$query = $this->db->query('SELECT * from registrations_details where member_id ='.$key);
		$array = $query->result();

		if ($medical != 'null') {
			$this->db->where('member_id', $key);
			$this->db->delete('medical_conditions_details');

			foreach($medical as $id => $value) {
				$this->db->set('member_id', $key);
				$this->db->set('medical_condition_id', $id);				
				$this->db->insert('medical_conditions_details');
			}
		}
		
		$this->dbUpdateMemberSkills($skill, $key);
		
		return json_encode($array);
	}

	function dbAddParent($array) {
		$this->db->insert('registrations_master', $array);
	}

	function dbAddChild($array, $medical, $skill) {
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

	function dbGetSelectChild($regId) {
		$string = '';
		$this->db->select("member_id, member_fname, member_lname");
		$this->db->from('registrations_details');
		$this->db->where('registration_id', $regId);
		$query = $this->db->get();

		foreach($query->result() as $row) {
			$string .= '<option value="'.$row->member_id.'">'.$row->member_fname.' '.$row->member_lname.'</option>';
		}
		return $string;
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
}

?>
