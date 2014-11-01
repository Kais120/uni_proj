<?php 
	class model_group extends CI_Model{		
		
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
		
		function db_get_children_list($groupId, $skillId, $term){
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
							
			$this->db->select("gd.member_id");
			$this->db->from("groups_details gd, groups_master gm");
			$this->db->where("gd.group_id = gm.group_id");
			$this->db->where("gm.skill_id", $skillId);
			$this->db->where("gm.term_id", $term);
			$query = $this->db->get();
			$result = $query->result();
			$members = array();
			foreach ($result as $row){
				$members[]=$row->member_id;
			}
			
			$this->db->select("rd.member_id, rd.member_fname, rd.member_lname");
			$this->db->from("registrations_details rd, members_skills ms");
			$this->db->where("ms.member_id = rd.member_id");
			$this->db->where("ms.skill_id", $skillId);
			if (count($members)>0)
				$this->db->where_not_in("rd.member_id",$members);
			$query = $this->db->get();
			$result = $query->result();
			
			foreach ($result as $row){				
				$string.='<tr><td class="member_id">'.$row->member_id.'</td><td>'.$row->member_fname.'</td><td>'.
					$row->member_lname.'</td><td><input type="checkbox" name="in_group" class="in_group" value="true"></td></tr>';
			}		
			
			return $string;
		}
		
		function db_get_children_list_staff($groupId, $skillId, $term){
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
					$row->member_lname.'</td></tr>';
				$array[] = $row->member_id;
			}	
			
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
			$this->dbUpdatePayment($memberId, $groupId);
		}
		
		function dbRemoveMemberGroup($memberId, $groupId){
			$array = array(
				'member_id' => $memberId,
				'group_id' => $groupId
			);
			$this->db->delete('groups_details', $array);
		}
		
		function db_update_member_progress($memberId, $schedId, $tasks, $attend, $staffId, $notes){
			$progressId = 0;			
			$this->db->select("progress_id");
			$this->db->from("members_progress");
			$this->db->where("schedule_id", $schedId);
			$this->db->where("member_id", $memberId);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$attendance=0;
				if ($attend=='true')
					$attendance = 1;				
				$row = $query->row();
				$progressId = $row->progress_id;				
				$this->db->where('progress_id', $progressId);
				$this->db->update('members_progress', array('attendance' => $attendance, 'staff_id' => $staffId, 'staff_comments' => $notes));				
				$this->db->where("progress_id", $progressId);
				$this->db->delete('members_progress_details'); 					
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
			}
			if ($tasks!="")
				foreach ($tasks as $value){					
					$this->db->set('progress_id', $progressId);
					$this->db->set('task_id',$value);
					$this->db->insert('members_progress_details');
				}									
		}	
		
		function db_update_group($groupId, $group, $sched){
			$startTime = new DateTime($sched['start_time']);
			$endTime = new DateTime($sched['end_time']);
			
			if ($startTime >= $endTime)
				return 'fail';
			
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
			return 'success';
		}
		
		function db_create_group($group, $sched){
			$startTime = new DateTime($sched['start_time']);
			$endTime = new DateTime($sched['end_time']);
			
			if ($startTime >= $endTime)
				return 'fail';
		
			$this->db->query('ALTER TABLE groups_master AUTO_INCREMENT = 1');
			$this->db->insert('groups_master', $group);
			$sched['group_id'] = $this->db->insert_id();
			$this->db->insert('schedule_master', $sched);	
			$this->db->query('ALTER TABLE schedule_master AUTO_INCREMENT = 1');
			$this->dbPopulateSchedule($sched['group_id'], $group['term_id'], $sched);
			return 'success';
		}
		
		private function dbUpdateSchedule($groupId, $termId, $sched){
			$this->db->query('ALTER TABLE schedule_details AUTO_INCREMENT = 1');
			$this->db->select('start_date, end_date');
			$this->db->from('terms');
			$this->db->where('term_id', $termId);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0){
				$this->db->where('schedule_date >',date('Y-m-d'));
				$this->db->where('group_id =', $groupId);
				$this->db->delete('schedule_details'); 
				$values = array();
				$begin = new DateTime(date('Y-m-d'));
				$end = new DateTime($query->row()->end_date);
				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($begin, $interval, $end);
				if ($begin < $end){					
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
		}
		
		private function dbPopulateSchedule($groupId, $termId, $sched){
			$this->db->query('ALTER TABLE schedule_details AUTO_INCREMENT = 1');
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
		
			
		function dbGetPerformedTasks($progress){
			$string='<h4>Tasks performed:</h4>';
			$string.='<ul>';
			$this->db->select('sd.task_description');
			$this->db->from('skills_details sd, members_progress_details mpd, members_progress mp');
			$this->db->where('mpd.task_id = sd.task_id and mpd.progress_id = mp.progress_id');
			$this->db->where('mp.progress_id', $progress);
			$query = $this->db->get();
			
			foreach($query->result() as $row){
				$string.='<li>'.$row->task_description.'</li>';
			}
			$string.='</ul>';
			return $string;
		}
		
		private function dbUpdatePayment($child, $group){
			$this->db->select('payment_id');
			$this->db->from('payments_master');
			$this->db->where('member_id', $child);
			$this->db->where('group_id', $group);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0){
				$array=array(
					'number_lessons' => 0,
					'total_amount' => 0
				);
				$paymentId = $query->row()->payment_id;
				
				$this->db->select('ms.number_lessons, ls.cost');
				$this->db->from('members_skills ms, groups_master gm, groups_details gd, lessons ls');
				$this->db->where('ms.member_id', $child);
				$this->db->where('gd.group_id', $group);
				$this->db->where('gd.member_id = ms.member_id and gd.group_id = gm.group_id and gm.lesson_id = ls.lesson_id and ms.skill_id = gm.skill_id');
				$query = $this->db->get();
				
				if ($query->num_rows() > 0){
					$array=array(
						'number_lessons' => $query->row()->number_lessons,
						'total_amount' => intval($query->row()->number_lessons) * intval($query->row()->cost)					
					);
					$this->db->where('payment_id', $paymentId);
					$this->db->update('payments_master', $array);
				}
				
			}else{
				$this->db->select('ms.number_lessons, ls.cost');
				$this->db->from('members_skills ms, groups_master gm, groups_details gd, lessons ls');
				$this->db->where('ms.member_id', $child);
				$this->db->where('gd.group_id', $group);
				$this->db->where('gd.member_id = ms.member_id and gd.group_id = gm.group_id and gm.lesson_id = ls.lesson_id and ms.skill_id = gm.skill_id');
				$query = $this->db->get();
				
				if ($query->num_rows() > 0){
					$array=array(
						'number_lessons' => $query->row()->number_lessons,
						'total_amount' => intval($query->row()->number_lessons) *  intval($query->row()->cost)
					);
					$this->db->insert('payments_master', array(
							'member_id' => $child,
							'group_id' => $group,
							'number_lessons' => $array['number_lessons'],
							'total_amount' => $array['total_amount']
					));
					
				}
			}
		}
		
		function db_get_assignments($term){
			$string='';
			$this->db->select('st.staff_fname, st.staff_lname, sp.sport_description, sk.skill_band, gm.group_name');
			$this->db->from('staff st, sports sp, skills_master sk, groups_master gm, schedule_master sm');
			$this->db->where('sm.staff_id = st.staff_id and sm.group_id = gm.group_id and gm.skill_id = sk.skill_id 
				and sk.sport_id = sp.sport_id');
			$this->db->where('gm.term_id', $term);
			$query=$this->db->get();
			foreach ($query->result() as $row){
				$string.='
					<tr>
						<td>'.$row->staff_fname.' '.$row->staff_lname.'</td>
						<td>'.$row->sport_description.'</td>
						<td>'.$row->skill_band.'</td>
						<td>'.$row->group_name.'</td>
					</tr>
				';
			}
			return $string;
		}
		
		function db_get_group_name($groupId){
			$string='';

			$skill = $this->db_get_group_skill($groupId);
			
			$this->db->select('gm.group_id, gm.group_name');
			$this->db->from('groups_master gm, skills_master sm');	
			$this->db->where("gm.skill_id = sm.skill_id");
			$this->db->where("sm.skill_id", $skill);			
			
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row){
				if ($groupId==$row->group_id)
					$string.="<option value='".$row->group_id."' selected>".$row->group_name."</option>";
				else
					$string.="<option value='".$row->group_id."'>".$row->group_name."</option>";
			}
			return $string;
		}
		
		function db_get_select_group_skill($groupId){
			$string='';
			$sport = $this->db_get_group_sport($groupId);
			$skill = $this->db_get_group_skill($groupId);
			
			$this->db->select('skill_id, skill_band');
			$this->db->from('skills_master');			
			$this->db->where('sport_id', $sport);
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row){
				if ($skill==$row->skill_id)
					$string.="<option value='".$row->skill_id."' selected>".$row->skill_band."</option>";
				else
					$string.="<option value='".$row->skill_id."'>".$row->skill_band."</option>";
			}	
			return $string;
		}
		
		private function db_get_group_skill($groupId){
			$this->db->select('skill_id');
			$this->db->from('groups_master');
			$this->db->where('group_id',$groupId);
			return $this->db->get()->row()->skill_id;
		}
		
		function db_get_select_group_term($groupId){
			$string='';
			
			$year = $this->db_get_group_year($groupId);					
			$term = $this->db_get_group_term($groupId);	
			
			$this->db->select('term_id, term_description');
			$this->db->from('terms');
			$this->db->where('YEAR(start_date)', $year);			
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $row){
				if ($term==$row->term_id)
					$string.="<option value='".$row->term_id."' selected>".$row->term_description."</option>";
				else
					$string.="<option value='".$row->term_id."'>".$row->term_description."</option>";
			}
			return $string;
		}
		
		private function db_get_group_term($groupId){
			$this->db->select('term_id');
			$this->db->from('groups_master');
			$this->db->where('group_id', $groupId);	
			return $this->db->get()->row()->term_id;
		}
		
		function db_get_group_sport($groupId){
			$this->db->select('sk.sport_id');
			$this->db->from('groups_master gm, skills_master sk');
			$this->db->where('gm.skill_id = sk.skill_id');
			$this->db->where('gm.group_id', $groupId);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->row()->sport_id;
			}			
		}
		
		private function db_get_group_year($groupId){
			$this->db->select('YEAR(t.start_date) as year');
			$this->db->from('terms t, groups_master gm');
			$this->db->where('gm.term_id = t.term_id');
			$this->db->where('gm.group_id', $groupId);
			return $year = $this->db->get()->row()->year;
		}
		
		function db_get_select_group_year($groupId){
			$string='';
			$year = $this->db_get_group_year($groupId);
			$query = $this->db->query('SELECT DISTINCT YEAR(start_date) AS year FROM terms');	
			$result = $query->result();
			foreach ($result as $row){
				if ($year==$row->year)
					$string.="<option value='".$row->year."' selected>".$row->year."</option>";
				else
					$string.="<option value='".$row->year."'>".$row->year."</option>";
			}
			return $string;
		}
	
	}

?>