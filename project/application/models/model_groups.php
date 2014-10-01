<?php 
	class model_groups extends CI_Model{		
		
		function dbGetSkills($sport){
			$sportId=0;
			switch (strtolower($sport)){
				case 'tennis':
					$sportId = 1;
					break;
				case 'swimming':
					$sportId =  2;
					break;
			}			
			$this->db->select("skill_id, skill_band");
			$this->db->from("skills_master");
			$this->db->where("sport_id", $sportId);			
			$query = $this->db->get();
			$result = $query->result();
			$string = '';
			foreach ($result as $row){
				$string.='<option value="'.$row->skill_id.'">'.$row->skill_band.'</option>';
			}			
			return $string;
		}	

		function dbGetGroupSelect($termId, $skillId){
			$this->db->select("group_id, group_name");
			$this->db->from("groups_master");
			$this->db->where("term_id", $termId);			
			$this->db->where("skill_id", $skillId);			
			$query = $this->db->get();
			$result = $query->result();
			$string = '';
			foreach ($result as $row){
				$string.='<option value="'.$row->group_id.'">'.$row->group_name.'</option>';
			}			
			return $string;
		}
		
		function dbGetLessonsSelect($sport, $groupId){
			$sportId=0;
			$groupLesson=0;
			switch (strtolower($sport)){
				case 'tennis':
					$sportId = 1;
					break;
				case 'swimming':
					$sportId =  2;
					break;
			}
			$this->db->select("lesson_id");
			$this->db->from("groups_master");
			$this->db->where("group_id", $groupId);
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row){
				$groupLesson = $row->lesson_id;
			}
			

			$this->db->select("lesson_id, lesson_description");
			$this->db->from("lessons");
			$this->db->where("sport_id", $sportId);
			$query = $this->db->get();
			$result = $query->result();
			
			$string='';
			foreach ($result as $row){
				if ($row->lesson_id == $groupLesson)
					$string.='<option value="'.$row->lesson_id.'" selected>'.$row->lesson_description.'</option>';
				else
					$string.='<option value="'.$row->lesson_id.'">'.$row->lesson_description.'</option>';
			}
			
			return $string;
		}
		
		function dbGetGroupDay($groupId){
			$this->db->select("weekday");
			$this->db->from("schedule_master");
			$this->db->where("group_id", $groupId);
			$query = $this->db->get();
			$result='';
			
			if ($query->num_rows() > 0)
			{
			   $row = $query->row();
			   $result= $row->weekday;			   
			}
			
			return $result;
			
		}
		
		function dbGetNumPeople($groupId){
			$this->db->select("max_number");
			$this->db->from("groups_master");
			$this->db->where("group_id", $groupId);
			$query = $this->db->get();
			$result='';
			
			if ($query->num_rows() > 0)
			{
			   $row = $query->row();
			   $result= $row->max_number;			   
			}
			
			return $result;
			
		}
		
		function dbGroupTimes($groupId){
			$this->db->select("start_time, end_time");
			$this->db->from("schedule_master");
			$this->db->where("group_id", $groupId);
			$query = $this->db->get();
			$result=array(
				'start_time' => '',
				'end_time' => ''
			);
			
			if ($query->num_rows() > 0)
			{
			   $row = $query->row();
			   $result['start_time']= $row->start_time;			   
			   $result['end_time']= $row->end_time;			   
			}
			
			return json_encode($result);
			
		}
		
		function dbGetChildrenList($groupId, $skillId){
			$string='';
			$array = array();
			$this->db->select("r.member_id, r.member_fname, r.member_lname");
			$this->db->from("registrations_details r, groups_details g");
			$this->db->where("g.member_id = r.member_id");
			$this->db->where("g.group_id", $groupId);
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row){
				$string.='<tr><td class="member_id">'.$row->member_id.'</td><td>'.$row->member_fname.'</td><td>'.
					$row->member_lname.'</td><td><input type="checkbox" class="in_group" value="true" checked></td></tr>';
				$array[] = $row->member_id;
			}	
			
			$this->db->select("rd.member_id, rd.member_fname, rd.member_lname");
			$this->db->from("registrations_details rd, members_skills ms");
			$this->db->where("rd.member_id = ms.member_id");
			$this->db->where("ms.skill_id", $skillId);
			$this->db->join('groups_details gr', 'rd.member_id = gr.member_id', 'left');
			$this->db->where("gr.member_id", null);
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row){				
				$string.='<tr><td class="member_id">'.$row->member_id.'</td><td>'.$row->member_fname.'</td><td>'.
					$row->member_lname.'</td><td><input type="checkbox" name="in_group" class="in_group" value="true"></td></tr>';
			}
			
			/*$this->db->select("r.member_id, r.member_fname, r.member_lname");
			$this->db->from("registrations_details r, members_skills s");
			$this->db->where("s.member_id = r.member_id");
			$this->db->where("s.skill_id", $skillId);
			if (sizeof($array)>0)
				$this->db->where_not_in("r.member_id", $array);
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row){
				$string.='<tr><td class="member_id">'.$row->member_id.'</td><td>'.$row->member_fname.'</td><td>'.
					$row->member_lname.'</td><td><input type="checkbox" name="in_group" class="in_group" value="true"></td></tr>';
			}*/
			return $string;
		}
		
		function dbGetTrainingDays($groupId){
			$string='';
			$scheduleId=0;
			$this->db->select("schedule_id, schedule_date");
			$this->db->from("schedule_details");
			$this->db->where("group_id", $groupId);				
			$query = $this->db->get();
			$result = $query->result();
			
			foreach ($result as $row){
				$string.='<option value="'.$row->schedule_id.'">'.date("d/m/Y", strtotime($row->schedule_date)).'</option>';
			}
			
			return $string;
		
		}
		
		function dbGetGroupTasks($skillId){
			$string='';
			$this->db->select("task_id, task_description");
			$this->db->from("skills_details");
			$this->db->where("skill_id", $skillId);
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row){
				$string.='<tr data-value="'.$row->task_id.'"><td>'.$row->task_description.'</td>
					<td><input type="checkbox" name="accomplished" class="accomplished" value="true"></td></tr>';
			}
			return $string;			
		}
		
		function dbGetMemberProgress($schedId, $memberId){
			$progressId = 0;
			$tasks = array();			
			$array = array(
				'attendance' => 0,
				'tasks' => array(),
				'notes' => ''
			);
			$this->db->select("attendance, progress_id, staff_comments");
			$this->db->from("members_progress");
			$this->db->where('schedule_id', $schedId);
			$this->db->where('member_id', $memberId);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$row = $query->row();
				$progressId = $row->progress_id;
				$array['attendance'] = $row->attendance;
				$array['notes'] = $row->staff_comments;
			}
			if ($progressId>0){
				$this->db->select("task_id");
				$this->db->from("members_progress_details");
				$this->db->where('progress_id', $progressId);
				$query = $this->db->get();
				$result = $query->result();
				foreach ($result as $row){
					$tasks[] = $row->task_id;
				}
				$array['tasks'] = $tasks;
			}
			
			return json_encode($array);
		}
		
		function dbAddMemberGroup($memberId, $groupId){
			$array = array(
				'member_id' => $memberId,
				'group_id' => $groupId
			);
			$this->db->insert('groups_details', $array);
		}
		
		function dbRemoveMemberGroup($memberId, $groupId){
			$array = array(
				'member_id' => $memberId,
				'group_id' => $groupId
			);
			$this->db->delete('groups_details', $array);
		}
		
		function dbUpdateMemberProgress($memberId, $schedId, $tasks, $attend, $staffId, $notes){
			$progressId = 0;
			$taskList = json_decode($tasks);
			$this->db->select("progress_id");
			$this->db->from("members_progress");
			$this->db->where("schedule_id", $schedId);
			$this->db->where("member_id", $memberId);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				if ($attend=='true')
					$attendance = 1;
				$arrayToInsert = array();
				$row = $query->row();
				$progressId = $row->progress_id;
				
				$this->db->where('progress_id', $progressId);
				$this->db->update('members_progress', array('attendance' => $attendance, 'staff_id' => $staffId, 'staff_comments' => $notes));
				
				$this->db->where("progress_id", $progressId);
				$this->db->delete('members_progress_details'); 
				
				foreach ($taskList as $value){
					$arrayToInsert[] = array (
						'progress_id' => $progressId,
						'task_id' => $value
					);
				}
				
				$this->db->insert_batch('members_progress_details', $arrayToInsert); 
			}else{
				$attendance = 0;
				if ($attend=='true')
					$attendance = 1;
				$arrayToInsert = array(
					'schedule_id' => $schedId,
					'member_id' => $memberId,
					'attendance' => $attendance,
					'staff_id' => $staffId,
					'staff_comments' => $notes
				);
				
				$this->db->insert('members_progress', $arrayToInsert); 
				$progressId = $this->db->insert_id();
				$arrayToInsert = array();
				
				foreach ($taskList as $value){
					$arrayToInsert[] = array (
						'progress_id' => $progressId,
						'task_id' => $value
					);
					
				}
				
				$this->db->insert_batch('members_progress_details', $arrayToInsert); 
			}
		}	
		
		function dbUpdateGroup($groupId, $group, $sched){
			$this->db->where('group_id', $groupId);
			$this->db->update('groups_master', $group);
			$this->db->where('group_id', $groupId);
			$array = $this->getDatesDay($groupId);
			if ($sched['start_time']==$array['start_time'] && $sched['end_time']==$array['end_time'] && $sched['weekday']==$array['weekday']){
				$this->db->where('group_id', $groupId);
				$this->db->update('schedule_master',array('staff_id' => $sched['staff_id']));
			}else{
				$this->db->where('group_id', $groupId);
				$this->db->update('schedule_master', $sched);
				$this->dbUpdateSchedule($groupId, $group['term_id'], $sched);
			}
		}
		
		function dbCreateGroup($group, $sched){
			$this->db->insert('groups_master', $group);
			$sched['group_id'] = $this->db->insert_id();
			$this->db->insert('schedule_master', $sched);	
			$this->db->query('ALTER TABLE schedule_master AUTO_INCREMENT = 1');
			$this->dbPopulateSchedule($sched['group_id'], $group['term_id'], $sched);
		}
		
		private function dbUpdateSchedule($groupId, $termId, $sched){
			$this->db->delete('schedule_details', array('group_id' => $groupId));
			$this->db->query('ALTER TABLE schedule_details AUTO_INCREMENT = 1');
			$this->dbPopulateSchedule($groupId, $termId, $sched);
		}
		
		private function dbPopulateSchedule($groupId, $termId, $sched){
			$this->db->select('start_date, end_date');
			$this->db->from('terms');
			$this->db->where('term_id', $termId);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0){
				$values = array();
				$begin = new DateTime($query->row()->start_date);
				$end = new DateTime($query->row()->end_date);
				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($begin, $interval, $end);
				foreach ( $period as $dt ){
					if (date("w",$dt->getTimestamp())==$sched['weekday'])
					$values[]=array(						
						'group_id' => $groupId,
						'schedule_date' => $dt->format("Ymd"),
						'start_time' => $sched['start_time'],
						'end_time' => $sched['end_time']						
					);
				}				
				$this->db->insert_batch('schedule_details', $values); 
			}
		}
		
		private function getDatesDay($groupId){
			$array = array(
				'start_time' => '',
				'end_time' => '',
				'weekday' => ''
			);
			$this->db->select('start_time, end_time, weekday');
			$this->db->from('schedule_master');
			$this->db->where('group_id', $groupId);
			$query = $this->db->get();
			if ($query->num_rows() > 0){				
				$array['start_time'] = $query->row()->start_time;
				$array['end_time'] = $query->row()->end_time;
				$array['weekday'] = $query->row()->weekday;
			}
			
			return $array;
		}
	
	}

?>